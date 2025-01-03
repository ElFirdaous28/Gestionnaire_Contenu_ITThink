<?php include '../includes/check_loged_in.php';?>

<?php include '../controllers/projects/show_projects.php';?>
<?php include '../controllers/projects/delete_project.php';?>

<?php include '../controllers/categories/show_categories.php';?>
<?php include '../controllers/subcategories/show_sub_categories.php';?>
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
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="users.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z" />
                    </svg>  
                    <span class="mx-3">Users</span>
                </a>
                
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="categories.php">
                    <svg class="w-6 h-6" fill="#6b7280"  viewBox="0 0 35 35" data-name="Layer 2" id="e73e2821-510d-456e-b3bd-9363037e93e3" xmlns="http://www.w3.org/2000/svg"><path d="M11.933,15.055H3.479A3.232,3.232,0,0,1,.25,11.827V3.478A3.232,3.232,0,0,1,3.479.25h8.454a3.232,3.232,0,0,1,3.228,3.228v8.349A3.232,3.232,0,0,1,11.933,15.055ZM3.479,2.75a.73.73,0,0,0-.729.728v8.349a.73.73,0,0,0,.729.728h8.454a.729.729,0,0,0,.728-.728V3.478a.729.729,0,0,0-.728-.728Z"/><path d="M11.974,34.75H3.52A3.233,3.233,0,0,1,.291,31.521V23.173A3.232,3.232,0,0,1,3.52,19.945h8.454A3.232,3.232,0,0,1,15.2,23.173v8.348A3.232,3.232,0,0,1,11.974,34.75ZM3.52,22.445a.73.73,0,0,0-.729.728v8.348a.73.73,0,0,0,.729.729h8.454a.73.73,0,0,0,.728-.729V23.173a.729.729,0,0,0-.728-.728Z"/><path d="M31.522,34.75H23.068a3.233,3.233,0,0,1-3.229-3.229V23.173a3.232,3.232,0,0,1,3.229-3.228h8.454a3.232,3.232,0,0,1,3.228,3.228v8.348A3.232,3.232,0,0,1,31.522,34.75Zm-8.454-12.3a.73.73,0,0,0-.729.728v8.348a.73.73,0,0,0,.729.729h8.454a.73.73,0,0,0,.728-.729V23.173a.729.729,0,0,0-.728-.728Z"/><path d="M27.3,15.055a7.4,7.4,0,1,1,7.455-7.4A7.437,7.437,0,0,1,27.3,15.055Zm0-12.3a4.9,4.9,0,1,0,4.955,4.9A4.935,4.935,0,0,0,27.3,2.75Z"/></svg> 
                    <span class="mx-3">Categories</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
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
                    <div class="flex justify-between items-end mb-10">
                        <h3 class="text-3xl font-medium text-gray-700">My Projects</h3>
                        <form method="GET">
                            <div class="relative mx-4 lg:mx-0">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                                <input type="text" name="projectToSearch" onchange="this.form.submit()" class="w-32 pl-10 py-1 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600 focus:outline-none" placeholder="Search" value="<?= isset($_GET['projectToSearch']) ? htmlspecialchars($_GET['projectToSearch']) : '' ?>">
                            </div>
                        </form>
                        <!-- filter by status -->
                        <form method="GET">
                            <select name="filter_by_status" class="rounded-lg px-2 py-1 focus:outline-none" onchange="this.form.submit()">
                                <option value="all" <?= isset($_GET['filter_by_status']) && $_GET['filter_by_status'] == 'all' ? 'selected' : '' ?>>All Status</option>
                                <option value="1" <?= isset($_GET['filter_by_status']) && $_GET['filter_by_status'] == '1' ? 'selected' : '' ?>>Pending</option>
                                <option value="2" <?= isset($_GET['filter_by_status']) && $_GET['filter_by_status'] == '2' ? 'selected' : '' ?>>In Progress</option>
                                <option value="3" <?= isset($_GET['filter_by_status']) && $_GET['filter_by_status'] == '3' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </form>
                        <!-- filter by category -->
                        <form method="GET">
                            <select name="filter_by_cat" class="rounded-lg px-2 py-1 focus:outline-none" onchange="this.form.submit()">
                                <option value="all" <?= isset($_GET['filter_by_cat']) && $_GET['filter_by_cat'] == 'all' ? 'selected' : '' ?>>All Categories</option>
                                <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= htmlspecialchars($categorie['nom_categorie']); ?>" 
                                        <?= isset($_GET['filter_by_cat']) && $_GET['filter_by_cat'] == $categorie['nom_categorie'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($categorie['nom_categorie']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                        <!-- filter by subcategory -->
                        <form method="GET">
                            <select name="filter_by_sub_cat" class="rounded-lg px-2 py-1 focus:outline-none" onchange="this.form.submit()">
                                <option value="all" <?= isset($_GET['filter_by_sub_cat']) && $_GET['filter_by_sub_cat'] == 'all' ? 'selected' : '' ?>>All Subcategories</option>
                                <?php foreach ($subcategories as $subcategorie): ?>
                                    <option value="<?= htmlspecialchars($subcategorie['nom_sous_categorie']); ?>" 
                                        <?= isset($_GET['filter_by_sub_cat']) && $_GET['filter_by_sub_cat'] == $subcategorie['nom_sous_categorie'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($subcategorie['nom_sous_categorie']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>
                    <table class="min-w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Title</th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Description</th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Category</th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase border-b border-gray-200 bg-gray-50">SubCategory</th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Status</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <!-- projects -->
                            <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="project_title text-sm font-medium leading-5 text-gray-900"><?= htmlspecialchars($project['titre_projet']); ?></div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="project_description text-sm leading-5 text-gray-900 w-full"><?= $project['description'] !== null ? htmlspecialchars($project['description']) : ''; ?></div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="project_category text-sm leading-5 text-gray-900 w-full" data-category-id="<?=$project['id_categorie']?>"><?= $project['nom_categorie'] !== null ? htmlspecialchars($project['nom_categorie']) : ''; ?></div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="project_sub_category text-sm leading-5 text-gray-900 w-full" data-sous-category-id="<?=$project['id_sous_categorie']?>">
                                            <?= $project['nom_sous_categorie'] !== null ? htmlspecialchars($project['nom_sous_categorie']) : ''; ?></div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="project_status text-sm leading-5 text-gray-900 w-full"><?= $project['project_status']==1?"Pending":($project['project_status']==2?"In Progress":"Completed ") ?></div>
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200 flex justify-evenly">
                                        <!-- Remove Project Form with Confirmation -->
                                        <form method="POST" class="mb-0" onsubmit="return confirm('Are you sure you want to remove this project?');">
                                            <input type="hidden" name="id_projet" value="<?= $project['id_projet']; ?>">
                                            <button type="submit" name="remove_project" class="text-indigo-600 hover:text-indigo-900">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</div>
<script data-cfasync="false" src="https://www.creative-tim.com/twcomponents/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8e2ed63ffe793144","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2024.10.5","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
</body>
</html>
