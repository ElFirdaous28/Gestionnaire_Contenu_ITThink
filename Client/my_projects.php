
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

    
    <title>ITThink</title>
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
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25" href="dashboard.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
    
                    <span class="mx-3">Dashboard</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25 hover:text-gray-100"
                    href="my_projects.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    <span class="mx-3">My Projects</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="my_offers.php">
                    <svg fill="#6b7280" class="w-6 h-6" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26 4.75h-2c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h0.75v21.5h-17.5v-21.5h0.75c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0h-2c-0.69 0-1.25 0.56-1.25 1.25v0 24c0 0.69 0.56 1.25 1.25 1.25h20c0.69-0.001 1.249-0.56 1.25-1.25v-24c-0-0.69-0.56-1.25-1.25-1.25h-0zM11 9.249h10c0.69 0 1.25-0.56 1.25-1.25s-0.56-1.25-1.25-1.25v0h-1.137c0.242-0.513 0.385-1.114 0.387-1.748v-0.001c0-2.347-1.903-4.25-4.25-4.25s-4.25 1.903-4.25 4.25v0c0.002 0.635 0.145 1.236 0.398 1.775l-0.011-0.026h-1.137c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0zM14.25 5c0-0 0-0.001 0-0.001 0-0.966 0.784-1.75 1.75-1.75s1.75 0.784 1.75 1.75c0 0.966-0.784 1.75-1.75 1.75v0c-0.966-0.001-1.748-0.783-1.75-1.749v-0zM19.957 13.156l-6.44 7.039-1.516-1.506c-0.226-0.223-0.536-0.361-0.878-0.361-0.69 0-1.25 0.56-1.25 1.25 0 0.345 0.14 0.658 0.366 0.884v0l2.44 2.424 0.022 0.015 0.015 0.021c0.074 0.061 0.159 0.114 0.25 0.156l0.007 0.003c0.037 0.026 0.079 0.053 0.123 0.077l0.007 0.003c0.135 0.056 0.292 0.089 0.457 0.089 0.175 0 0.341-0.037 0.491-0.103l-0.008 0.003c0.053-0.031 0.098-0.061 0.14-0.094l-0.003 0.002c0.102-0.050 0.189-0.11 0.268-0.179l-0.001 0.001 0.015-0.023 0.020-0.014 7.318-8c0.203-0.222 0.328-0.518 0.328-0.844 0-0.69-0.559-1.25-1.25-1.25-0.365 0-0.693 0.156-0.921 0.405l-0.001 0.001z"></path>
                    </svg>
                    <span class="mx-3">My Offres</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="my_testimonials.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path> 
                    </svg>
                    <span class="mx-3">My Testimonials</span>
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
                                        <!-- modify button -->
                                        <button data-project-id="<?= htmlspecialchars($project['id_projet']); ?>" class="modify_project_button text-indigo-600 hover:text-indigo-900">Modify</button>
                                        <!-- Remove User Form with Confirmation -->
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
                <button id="add_project_button" class="text-gray-100 bg-gray-900 hover:bg-gray-700 p-3 mb-5 mr-5 rounded-sm float-right">Add Project</button>
            </main>
        </div>
    </div>
</div>


<!-- Add Project Popup -->
<div id="project_modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
    <div id="modal_content" class="flex flex-col w-11/12 md:w-5/12 overflow-y-auto scrollbar-hidden mx-auto mt-10 p-4 bg-gray-200 rounded-sm shadow-lg">
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Add Project</h1>
            <!-- Close Icon -->
            <button id="close_project_modal" class="flex justify-end items-center mb-4 float-right text-xl">&times;</button>
        </div>
        <!-- Add Project Form -->
        <form method="POST" action="../controllers/projects/add_modify_project.php" id="project_form" class="mt-[25%] md:px-10">
            <!-- Project Title -->
            <div class="flex w-full mb-4">
                <label for="project_title_input" class="text-gray-900 font-semibold w-1/3">Project Title:</label>
                <input type="text" name="project_title_input" id="project_title_input" value="" class="w-2/3 border-gray-300 rounded-md" required>
            </div>

            <!-- Description -->
            <div class="flex w-full mb-4">
                <label for="project_description_input" class="text-gray-900 font-semibold w-1/3">Description:</label>
                <textarea name="project_description_input" id="project_description_input" rows="4" class="w-2/3 border-gray-300 rounded-md" required></textarea>
            </div>

            <!-- Category -->
            <div class="flex w-full mb-4">
                <label for="project_category_input" class="text-gray-900 font-semibold w-1/3">Category:</label>
                <select name="project_category_input" id="project_category_input" class="w-2/3 border-gray-300 rounded-md" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= htmlspecialchars($categorie['id_categorie']); ?>">
                            <?= htmlspecialchars($categorie['nom_categorie']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Subcategory -->
            <div class="flex w-full mb-4">
                <label for="project_subcategory_input" class="text-gray-900 font-semibold w-1/3">Subcategory:</label>
                <select name="project_subcategory_input" id="project_subcategory_input" class="w-2/3 border-gray-300 rounded-md" required>
                    <option value="">Select a subcategory</option>
                    <?php foreach ($subcategories as $subcategorie): ?>
                        <option value="<?= htmlspecialchars($subcategorie['id_sous_categorie']); ?>">
                            <?= htmlspecialchars($subcategorie['nom_sous_categorie']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- status select -->
            <div id="status_select" class="hidden flex w-full mb-4">
                <label for="project_subcategory_input" class="text-gray-900 font-semibold w-1/3">Status:</label>
                <select name="project_subcategory_input" id="project_subcategory_input" class="w-2/3 border-gray-300 rounded-md" required>
                    <option value="1">Pending</option>
                    <option value="2">In Progress</option>
                    <option value="3">Completed</option>
                </select>
            </div>

            <!-- id category in case of inpur -->
            <input type="text" class="hidden" name="project_id_input" value="0" id="project_id_input">

            <div class="flex justify-end">
                <input type="submit" name="save_project" class="text-gray-100 bg-gray-700 border-2 border-gray-700 hover:bg-gray-900 px-8 py-1 mt-6 rounded-sm" value="Save">
            </div>
        </form>
    </div>
</div>

<script data-cfasync="false" src="https://www.creative-tim.com/twcomponents/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8e2ed63ffe793144","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2024.10.5","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>

<script>
    const modal = document.getElementById('project_modal');
    document.getElementById('close_project_modal').onclick = () => closeModal();

    // Show modal as add project
    document.getElementById('add_project_button').onclick = () => {
        showModal();
        document.getElementById('project_form').classList.remove("hidden");
    }

    // Show modal as modify project
    const modifyProjectButtons = document.querySelectorAll(".modify_project_button");
    modifyProjectButtons.forEach(modifyProjectButton => {
        modifyProjectButton.onclick = () => {
            showModal();
            document.getElementById("project_title_input").value=modifyProjectButton.closest("tr").querySelector(".project_title").textContent;            
            document.getElementById("project_description_input").value=modifyProjectButton.closest("tr").querySelector(".project_description").textContent;            
            document.getElementById("project_category_input").value=modifyProjectButton.closest("tr").querySelector(".project_category").getAttribute("data-category-id");            
            document.getElementById("project_subcategory_input").value=modifyProjectButton.closest("tr").querySelector(".project_sub_category").getAttribute("data-sous-category-id");            
            document.getElementById("project_id_input").value=modifyProjectButton.getAttribute("data-project-id");
            document.getElementById("status_select").classList.remove("hidden");
        }
    });

    function showModal() {
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.getElementById("status_select").classList.add("hidden");
        document.getElementById('project_form').reset();
    }
    window.onclick = (event) => {
        if (event.target === modal) {
            closeModal();
        }
    };
</script>

</body>
</html>