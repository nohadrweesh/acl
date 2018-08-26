<?php
/**
 * Created by PhpStorm.
 * User: RVM-13
 * Date: 1/30/2017
 * Time: 10:01 AM
 */

namespace App\Helpers;

use App\Framework\Exceptions\BadRequestException;
use phpDocumentor\Reflection\Types\Null_;


abstract class Mapper
{
    public static function MapEntity($destination, $source){
        $result = array();

        foreach ($source as $srcObj){
            $resultObj = new $destination;
            $sourceReflection = new \ReflectionObject($srcObj);
            foreach($resultObj as $key => $value){
                if($sourceReflection->hasProperty($key)){
                    if (gettype($resultObj->{$key}) == "object") {
                        self::MapEntity($destination->{$key}, $srcObj->{"get".ucfirst($key)}());
                    } else {
                        $resultObj->{$key} = $srcObj->{"get".ucfirst($key)}();
                    }
                }
            }
            $result[] = $resultObj;
        }
        return $result;
    }
    //This maps the request object($source) to a Dto($destination)

    public static function MapRequest($destination, $source){
        $source = (object)$source;
        $result = new $destination;
        $sourceReflection = new \ReflectionObject($source);
        foreach($result as $key => $value){
            if($sourceReflection->hasProperty($key)){
                if (gettype($result->{$key}) == "object") {
                    self::MapRequest($destination->{$key}, $source->{$key});
                } else {
                    $result->{$key} = $source->{$key};
                }
            }
        }
        return $result;
    }

    public static function MapDto($destination, $source){
        $source = (object)$source;
        $result = new $destination;
        $sourceReflection = new \ReflectionObject($source);
        foreach($result as $key => $value){
            if($sourceReflection->hasProperty($key)){
                if (gettype($result->{$key}) == "object") {
                    self::MapDto($destination->{$key}, $source->{$key});
                } else {
                    $result->{$key} = $source->{$key};
                }
            }
        }
        return $result;
    }

    public static function MapClass($destination, $source,array $innerobjects = []){

        $result = new $destination;
        //$sourceReflection = new \ReflectionObject($source);
        //dd(gettype($source->{"get".ucfirst('basicClassRoom')}()));
        $innerobjects_counter = 0;
        foreach($result as $key => $value){

            if(method_exists($source,"get".ucfirst($key)) && $source->{"get".ucfirst($key)}() !== null){
                if (gettype($result->{$key}) == "array") {
                    if(count($innerobjects) == $innerobjects_counter)
                        break;
                        // throw new BadRequestException("Mapping Error check the inner classes array");
                    else
                    {
                        $innerclass = new $innerobjects[$innerobjects_counter];
                        $innerobjects_counter++;
                        foreach ($source->{"get".ucfirst($key)}() as $object) {                 
                            $innerobject = self::MapClass($innerclass, $object);
                            array_push($result->{$key}, $innerobject);
                        }
                    }                    
                }
                elseif (gettype($source->{"get".ucfirst($key)}()) == "object") {
                    if(count($innerobjects) == $innerobjects_counter)
                        break;
                        // throw new BadRequestException("Mapping Error check the inner classes array");
                    else
                    {
                        $innerclass = new $innerobjects[$innerobjects_counter];
                        $innerobjects_counter++;                
                        $innerobject = self::MapClass($innerclass, $source->{"get".ucfirst($key)}());
                        $result->{$key} =  $innerobject;
                    }   
                // $result->{$key} = $source->{"get".ucfirst($key)}();
                //     self::MapEntityCollection($result->{$key}, $source->{"get".ucfirst($key)}());
                }
                else {
                    $result->{$key} = $source->{"get".ucfirst($key)}();
                }
            }
            elseif (method_exists($source,"get".ucfirst($key)) && $source->{"get".ucfirst($key)}() == null) {
                if($result->{$key} == 'object'){

                        if(count($innerobjects) == $innerobjects_counter)
                            break;
                        // throw new BadRequestException("Mapping Error check the inner classes array");
                        else
                        {
                            $result->{$key} = null;
                            $innerobjects_counter++;

                        }
                        // $result->{$key} = $source->{"get".ucfirst($key)}();
                        //     self::MapEntityCollection($result->{$key}, $source->{"get".ucfirst($key)}());
                }

            }
        }
        return $result;
    }

    public static function MapClassArray($destination,array $source) {
        $result = array();
        foreach ($source as $srcObj){
            $result[] = self::MapDto($destination,$srcObj);
        }
        return $result;
    }

    public static function merge($new_object,$old_object)
    {
        foreach ($new_object as $key => $value) {
            if($new_object->{$key} == null)
            {
                if($old_object->{$key} != null)
                    $new_object->{$key} = $old_object->{$key};
            }
        }
    }

    public static function MapEntityCollection($destination, $source,array $innerobjects = []){
        $result = array();
        
        foreach ($source as $srcObj){
            $innerobjects_counter = 0;
            $resultObj = new $destination;
            //$sourceReflection = new \ReflectionObject($srcObj);
            foreach($resultObj as $key => $value){
                //dd($srcObj->getPercentageOfStudentAssigned());
                if(method_exists($srcObj,"get".ucfirst($key)) && $srcObj->{"get".ucfirst($key)}() !== null){
                    //$resultObj->{$key} = $srcObj->{"get".ucfirst($key)}();

                    if (gettype($resultObj->{$key}) == "array") {
                        if(count($innerobjects) == $innerobjects_counter)
                            throw new BadRequestException("Mapping Error check the inner classes array");
                        $innerclass = new $innerobjects[$innerobjects_counter];
                        $innerobjects_counter++;
                        foreach ($srcObj->{"get".ucfirst($key)}() as $object) {                 
                            $innerobject = self::MapClass($innerclass, $object);
                            array_push($resultObj->{$key}, $innerobject);
                        }
                    }
                    elseif (gettype($srcObj->{"get".ucfirst($key)}()) == "object") {
                        if(count($innerobjects) == $innerobjects_counter)
                            break;
                            // throw new BadRequestException("Mapping Error check the inner classes array");
                        else
                        {
                            $innerclass = new $innerobjects[$innerobjects_counter];
                            $innerobjects_counter++;                
                            $innerobject = self::MapClass($innerclass, $srcObj->{"get".ucfirst($key)}());
                            $resultObj->{$key} =  $innerobject;
                        }   
                    // $result->{$key} = $source->{"get".ucfirst($key)}();
                    //     self::MapEntityCollection($result->{$key}, $source->{"get".ucfirst($key)}());
                    }
                    else {
                        $resultObj->{$key} = $srcObj->{"get".ucfirst($key)}();
                    }
                }
                elseif (method_exists($srcObj,"get".ucfirst($key)) && $srcObj->{"get".ucfirst($key)}() == null) {
                    if($resultObj->{$key} == 'object'){

                        if(count($innerobjects) == $innerobjects_counter)
                            break;
                        // throw new BadRequestException("Mapping Error check the inner classes array");
                        else
                        {
                            $resultObj->{$key} = null;
                            $innerobjects_counter++;

                        }
                        // $result->{$key} = $source->{"get".ucfirst($key)}();
                        //     self::MapEntityCollection($result->{$key}, $source->{"get".ucfirst($key)}());
                    }

                }
            }
            $result[] = $resultObj;
        }
        return $result;
    }

}