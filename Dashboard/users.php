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
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-start text-gray-600 hover:text-gray-900">
        <div class="flex gap-5 items-start">
            <img src="https://icons.veryicon.com/png/o/miscellaneous/management-console-icon-update-0318/users-84.png" jsaction="VQAsE" class="sFlh5c pT0Scc iPVvYb" style="max-width: 30px; height: 30px; width: 30px;" alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd" aria-hidden="false">
            <span class="text-2xl text-blue-600 font-bold">Users</span>
        </div>
        <!-- Add User -->
        <div>
            <td class="text-end w-full border border-gray-200">
                <div class="flex justify-end">
                    <button class="bg-orange-500 text-white py-1 px-4 rounded-full text-xl">+ Add User</button>
                </div>
            </td>
        </div>
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

    <script>
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
</body>
</html>