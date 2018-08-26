<form method="post" action="/school">
    {{csrf_field()}}
    <input type="text" placeholder="Type school Name" name="name">
    <input type="submit" value="Insert School"/>
    
    
</form>