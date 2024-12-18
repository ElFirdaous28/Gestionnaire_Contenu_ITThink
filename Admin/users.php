<?php
    function showUsers($condition){
        include '../connection.php';
        switch ($condition){
            case 'all':
                $resul = $conn->prepare("SELECT * FROM utilisateurs WHERE role != 1");
                break;
            case 'clients':
                $resul = $conn->prepare("SELECT * FROM utilisateurs WHERE role = 2");
                break;
            case 'freelancers':
                $resul = $conn->prepare("SELECT * FROM utilisateurs WHERE role = 3");
                break;
            default:
                $resul = $conn->prepare("SELECT * FROM utilisateurs WHERE role != 1");
                break;
        }
        $resul->execute();
        
        $users = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    // take the filter value
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all'; // Default to 'all' if no filter is selected
    $users = showUsers($filter);


    // function to remove user
    function removeUser($idUser){
        include '../connection.php';
        $removeUser = $conn->prepare("DELETE FROM utilisateurs WHERE id_utilisateur=?");
        $removeUser->execute([$idUser]);
    }
    
    // chech the post request to remove the user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_user'])) {
        $idUser = $_POST['remove_user'];
        removeUser($idUser);
        // Redirect to avoid form resubmission after page reload
        header("Location: users.php");
        exit();
    }

    // function to block user
    function changeStatus($idUser){
        include '../connection.php';

        // get the old status
        $stmt = $conn->prepare("SELECT is_active FROM utilisateurs WHERE id_utilisateur = ?");
        $stmt->execute([$idUser]);
        $currentStatus = $stmt->fetchColumn();

        $changeStatus = $conn->prepare("UPDATE utilisateurs SET is_active=? WHERE id_utilisateur=?");
        $changeStatus->execute([$currentStatus==0?1:0,$idUser]);
    }
    // chech the post request to block the user
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['block_user_id'])) {
        $idUser = $_POST['block_user_id'];
        changeStatus($idUser);
        // Redirect to avoid form resubmission after page reload
        header("Location: users.php");
        exit();
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Dashboard Template by khatabwedaa. </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">

    <div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
    
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"></path>
                    </svg>
                    
                    <span class="mx-2 text-2xl font-semibold text-white">Dashboard</span>
                </div>
            </div>
    
            <nav class="mt-10">
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 bg-opacity-25" href="dashboard.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
    
                    <span class="mx-3">Dashboard</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="users.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z" />
                    </svg>  
                    <span class="mx-3">Users</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="projects.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
    
                    <span class="mx-3">Projects</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="testimonials.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
    
                    <span class="mx-3">Testimonials</span>
                </a>
            </nav>
        </div>
        <div class="flex flex-col flex-1 overflow-hidden">
            <?php include '../includes/header.php';?>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex justify-between">
                    <h3 class="text-3xl font-medium text-gray-700">Users</h3>

                    <form method="GET">
                        <select name="filter" id="" class="rounded-lg px-2" onchange="this.form.submit()">
                            <option value="all" <?= isset($_GET['filter']) && $_GET['filter'] == 'all' ? 'selected' : '' ?>>ALL</option>
                            <option value="clients" <?= isset($_GET['filter']) && $_GET['filter'] == 'clients' ? 'selected' : '' ?>>Clients</option>
                            <option value="freelancers" <?= isset($_GET['filter']) && $_GET['filter'] == 'freelancers' ? 'selected' : '' ?>>Freelancers</option>
                        </select>
                    </form>

                    </div>
    
                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div
                                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Name</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Title</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Role</th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                        </tr>
                                    </thead>
    
                                    <tbody class="bg-white">
                                        <!-- users -->
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10 bg-gray-500 text-gray-100 text-2xl rounded-full flex justify-center items-center uppercase">
                                                            <?= htmlspecialchars($user['nom_utilisateur'])[0] ?>
                                                        </div>
        
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium leading-5 text-gray-900"><?= htmlspecialchars($user['nom_utilisateur']); ?></div>
                                                            <div class="text-sm leading-5 text-gray-500"><?= htmlspecialchars($user['email']); ?>
                                                        </div>
                                                    </div>
                                                </td>
        
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900 w-full"><?= $user['title'] !== null ? htmlspecialchars($user['title']) : ''; ?></div>
                                                </td>
        
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to change the status of this user?');">
                                                        <input type="hidden" name="block_user_id" value="<?= $user['id_utilisateur']; ?>">
                                                            <button type="submit" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                                <?= $user['is_active']==1?"Active": "blocked"?>
                                                            </button>
                                                    </form>
                                                </td>
        
                                                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    <?= $user['role']== 2 ? "client":"Freelancer"; ?>
                                                </td>
        
                                                <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                                    <!-- Remove User Form with Confirmation -->
                                                    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to remove this user?');">
                                                        <input type="hidden" name="remove_user" value="<?= $user['id_utilisateur']; ?>">
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Remove</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<script data-cfasync="false" src="https://www.creative-tim.com/twcomponents/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8e2ed63ffe793144","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2024.10.5","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
</body>

<script>
</script>
</html>
