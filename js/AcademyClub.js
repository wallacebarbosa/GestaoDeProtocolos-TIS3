
// database
 var database = new DatabaseManager();
 database.Initialize();
database.DoAuth();
 var usuarios;
 function OnGetAllUsers(users)
{
    usuarios = users.val();
    console.log(usuarios[0].nome);
}
 database.AddListernerUsers(OnGetAllUsers);
 // cookies managar
 function getCookie(name) 
{
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}
 function setCookie(name, value, expire) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expire);
    var c_value = escape(value) + ((expire == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = name + "=" + c_value;
}
