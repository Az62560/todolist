// const reload = document.getElementById('valid');

// function addTask() {
//     // Récupérer la valeur du champ de saisie
//     var newTaskValue = document.getElementById('newTask').value;

//     if (newTaskValue.trim() !== '') {
//         // Créer un nouvel élément de liste
//         var newTaskElement = document.createElement('li');
//         newTaskElement.textContent = newTaskValue;

//         // Ajouter la fonctionnalité de barrer au clic sur l'élément de liste
//         newTaskElement.onclick = function () {
//             this.classList.toggle('#todoList');
//         };

//         // dis.onclick = function () {
//         //     location.reload();  
//         // }

//         // Ajouter l'élément à la liste
//         document.getElementById('todoList').appendChild(newTaskElement);

//         // Effacer le contenu du champ de saisie
//         document.getElementById('newTask').value = '';
//     }
// }

// function logOut() {
//     window.location.href = "http://localhost/php/projet_binome/connexion.php";
// }

// document.getElementById('dis').addEventListener('click', logOut());