//---------------------------------------------------------------------------------------------------

firebase.initializeApp({
    apiKey: "AIzaSyC-gmxXyEg9q10C-HeYaGFQnhBrWt3QF74",
    authDomain: "academyclub-fae14.firebaseapp.com",
    databaseURL: "https://academyclub-fae14.firebaseio.com",
    projectId: "academyclub-fae14",
    storageBucket: "academyclub-fae14.appspot.com",
    messagingSenderId: "1065301796384"

    
  });


  const firestore = firebase.firestore();
  var storage = firebase.storage();
  var storageRef = storage.ref();
  

//----------------------------------------------------------------------------------------------------
  

  //verifica se o usuario esta logado e verifica se a documentos no database



function verificar(){

      firebase.auth().onAuthStateChanged(function(user) {  
                if(user)
                {
                    var isAnonymous = user.isAnonymous;
                    var uid = user.uid;
                    var docRef =  firestore.collection('usuarios').doc(`${uid}`)

                    console.log("esta logado")
                    getDB(docRef)
                    
//-------------------------------------------------------------------------------------------------------
     //nao permite que o usuario desconectado entre na pagina do perfil

        

        var storageRef = firebase.storage().ref();

        console.log(storageRef);
                }
                else
                {
                    alert('acesso nao permitido!!!!')
                    window.location.replace('index.html')
                    console.log("[Database] Desconectado!");
                }
    
            });

     }

//--------------------------------------------------------------------------------------------------------
//pega os dados do usuario









function getDB(docRef){


        //pega os documentos

        docRef.onSnapshot(function(doc) {

        var nome = doc.data().nome
        var curso = doc.data().curso
        console.log(nome)
      
        

        $(document).ready(function(){

            $("img.im-p").attr("src", "img/02.jpg");
            $(".user-photo h3").html(`${nome}`);
            
            if(curso != null){
            $(".user-photo p").html(`${curso}`);

            } else {
                $(".user-photo p").html(`Adicionar curso`);

            }
        

    });


        })


    }








//----------------------------------------------------------------------------------------------------------

            //logout do usuario

            function logout(){


                firebase.auth().signOut().then(function() {
                    // Sign-out successful.

                    console.log('desconectado')
                  }).catch(function(error) {
                    // An error happened.

                    alert("erroooooooooooooooooo")
                  })

            }


         



       


















