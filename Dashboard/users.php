<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mx-auto">
        <div class="flex gap-5 items-center text-gray-600 mt-5 hover:text-gray-900">
            <img src="https://icons.veryicon.com/png/o/miscellaneous/management-console-icon-update-0318/users-84.png" jsaction="VQAsE" class="sFlh5c pT0Scc iPVvYb" style="max-width: 30px; height: 30px; width: 30px;" alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd" aria-hidden="false">
            <span class="text-2xl text-blue-600 font-bold">Users</span>
            <!-- Bouton d'ajout d'utilisateur -->
            <button onclick="showAddUserForm()" class="text-green-500 hover:text-blue-500 py-1 px-2 rounded-full text-xl flex items-center justify-center">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <table class="w-full table-fixed mt-5">
            <thead>
                <tr class="bg-blue-700">
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">Full Name</th>
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">Email Address</th>
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">Phone</th>
                    <th class="w-1/4 py-4 px-6 text-center text-orange-500 font-bold uppercase">Permissions</th>
                    <th class="w-1/4 py-4 px-6 text-center text-orange-500 font-bold uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <!-- Contenu généré par PHP -->
                <?php
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "phblog";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);
                

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve users with their roles
                $sql = "SELECT utilisateurs.*, roles.nom_Role FROM utilisateurs JOIN roles ON utilisateurs.id_role = roles.id_role";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='py-4 px-6 text-center border-b border-gray-200'>" . $row['nom_utilisateur'] . "</td>";
                        echo "<td class='py-4 px-6 text-center border-b border-gray-200'>" . $row['email'] . "</td>";
                        echo "<td class='py-4 px-6 text-center border-b border-gray-200'>" . $row['mobil'] . "</td>";
                        echo "<td class='py-4 px-6 text-center border-b border-gray-200'>" . $row['nom_Role'] . "</td>";
                        echo "<td class='py-4 px-6 border-b border-gray-200'>
                                <button type='button' onclick='deleteUser(" . $row['id_utilisateur'] . ")' class='text-orange-500 hover:text-blue-500 py-1 px-2 rounded-full text-xl flex items-center justify-center'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td class='py-4 px-6 text-center border-b border-gray-200' colspan='5'>No users found.</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Formulaire pour ajouter un utilisateur (initiallement masqué) -->
    <div id="addUserForm" class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded-lg">
            <h2 class="text-xl font-bold mb-4">Add User</h2>
            <form id="userForm">
                <div class="mb-4">
                    <label for="fullName" class="block text-gray-700 font-bold mb-2">Full Name:</label>
                    <input type="text" id="fullName" name="fullName" class="border rounded-lg px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email Address:</label>
                    <input type="email" id="email" name="email" class="border rounded-lg px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-bold mb-2">Phone:</label>
                    <input type="text" id="phone" name="phone" class="border rounded-lg px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-bold mb-2">Role:</label>
                    <select id="role" name="role" class="border rounded-lg px-4 py-2 w-full">
                        <!-- Options pour les rôles -->
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
                    <button type="button" onclick="hideAddUserForm()" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<script>
    function showAddUserForm() {
        // Affiche le formulaire pour ajouter un utilisateur
        document.getElementById('addUserForm').classList.remove('hidden');
    }

    function hideAddUserForm() {
        // Masque le formulaire pour ajouter un utilisateur
        document.getElementById('addUserForm').classList.add('hidden');
    }

    // JavaScript pour envoyer les données du formulaire
    document.getElementById('userForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Récupérer les données du formulaire
        const formData = new FormData(this);
        // Envoyer les données au serveur via fetch ou XMLHttpRequest
        fetch('add_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Recharger la page après l'ajout d'utilisateur réussi
                window.location.reload();
            } else {
                // Gérer les erreurs éventuelles
            }
        })
        .catch(error => {
            console.error('Error adding user:', error);
        });
    });

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            // Send a request to delete the user
            fetch('delete_user.php', {
                method: 'POST',
                body: JSON.stringify({ userId: userId }),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    // Reload the page
                    window.location.reload();
                }
            });
        }
    }
</script>
