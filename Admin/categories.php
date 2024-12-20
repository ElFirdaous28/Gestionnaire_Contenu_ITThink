<?php
    include '../includes/check_loged_in.php';
    require_once "../connection.php";

    // add or modify category code
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add_modify_category"])) {
            $category_name = trim($_POST["category_name_input"]);
            $category_id = isset($_POST["category_id_input"]) ? trim($_POST["category_id_input"]) : '';

            if (!empty($category_name)) {
                // create a new category if id not gived
                if($category_id==0){
                    try {
                        $AddCategoryQuery = $conn->prepare("INSERT INTO categories (nom_categorie) VALUES (:category_name)");
                        $AddCategoryQuery->execute([':category_name' => $category_name]);
    
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
                // modify category if id gived
                else{
                    try {
                        $modifyCategoryQuery = $conn->prepare("UPDATE categories SET nom_categorie = ? WHERE id_categorie = ?");
                        $modifyCategoryQuery->execute([$category_name,$category_id]);
    
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
                
            } 
        } 
    }

    // add or modify subcategory code
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add_modify_subcategory"])) {
            $subcategory_name = trim($_POST["subcategory_name_input"]);
            $category_id = $_POST["category_parent_id_input"];
            $subcategory_id = (int)trim($_POST["subcategory_id_input"]);
            

            if (!empty($subcategory_name)) {
                // create a new subcategory if id not gived
                if($subcategory_id==0){
                    try {
                        $AddSubCategoryQuery = $conn->prepare("INSERT INTO sous_categories (nom_sous_categorie, id_categorie) VALUES (:subcategory_name, :category_id)");
                        $AddSubCategoryQuery->execute([':subcategory_name' => $subcategory_name,':category_id' => $category_id]);

    
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
                // modify subcategory if id gived
                else{
                    try {
                        $modifySubCategoryQuery = $conn->prepare("UPDATE sous_categories SET nom_sous_categorie = ? WHERE id_sous_categorie = ?");
                        $modifySubCategoryQuery->execute([$subcategory_name,$subcategory_id]);
    
                    } catch (PDOException $e) {
                        echo "Database Error: " . $e->getMessage();
                    }
                }
                
            } 
        } 
    }

    function getCategoriesWithSubcategories($conn) {
        try {
            $query = $conn->prepare("
                SELECT 
                    c.id_categorie,
                    c.nom_categorie,
                    sc.id_sous_categorie,
                    sc.nom_sous_categorie
                FROM 
                    categories c
                LEFT JOIN 
                    sous_categories sc ON c.id_categorie = sc.id_categorie
            ");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
            $categories = [];
            foreach ($results as $row) {
                $id_categorie = $row['id_categorie'];
    
                // Initialize category if not present
                if (!isset($categories[$id_categorie])) {
                    $categories[$id_categorie] = [
                        'id_categorie' => $id_categorie,
                        'nom_categorie' => $row['nom_categorie'],
                        'sous_categories' => []
                    ];
                }
    
                // Add subcategories
                if (!empty($row['id_sous_categorie'])) {
                    $categories[$id_categorie]['sous_categories'][] = [
                        'id_sous_categorie' => $row['id_sous_categorie'],
                        'nom_sous_categorie' => $row['nom_sous_categorie']
                    ];
                }
            }
    
            return $categories;
    
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return [];
        }
    }
    $categories = getCategoriesWithSubcategories($conn);

    // delete categorie
    if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["delete_categorie"])) {
        $id_categorie=$_POST['id_categorie'];

        $deleteCategorieQuery=$conn->prepare("DELETE FROM categories WHERE id_categorie=?");
        $deleteCategorieQuery->execute([$id_categorie]);
    }

    // delete subcategorie
    if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["delete_sub_category"])) {
        $id_sous_categorie=$_POST['id_sub_categorie'];

        $deleteSubCategorieQuery=$conn->prepare("DELETE FROM sous_categories WHERE id_sous_categorie=?");
        $deleteSubCategorieQuery->execute([$id_sous_categorie]);
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
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="users.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z" />
                    </svg>  
                    <span class="mx-3">Users</span>
                </a>
                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="categories.php">
                    <svg class="w-6 h-6" fill="#f3f4f6"  viewBox="0 0 35 35" data-name="Layer 2" id="e73e2821-510d-456e-b3bd-9363037e93e3" xmlns="http://www.w3.org/2000/svg"><path d="M11.933,15.055H3.479A3.232,3.232,0,0,1,.25,11.827V3.478A3.232,3.232,0,0,1,3.479.25h8.454a3.232,3.232,0,0,1,3.228,3.228v8.349A3.232,3.232,0,0,1,11.933,15.055ZM3.479,2.75a.73.73,0,0,0-.729.728v8.349a.73.73,0,0,0,.729.728h8.454a.729.729,0,0,0,.728-.728V3.478a.729.729,0,0,0-.728-.728Z"/><path d="M11.974,34.75H3.52A3.233,3.233,0,0,1,.291,31.521V23.173A3.232,3.232,0,0,1,3.52,19.945h8.454A3.232,3.232,0,0,1,15.2,23.173v8.348A3.232,3.232,0,0,1,11.974,34.75ZM3.52,22.445a.73.73,0,0,0-.729.728v8.348a.73.73,0,0,0,.729.729h8.454a.73.73,0,0,0,.728-.729V23.173a.729.729,0,0,0-.728-.728Z"/><path d="M31.522,34.75H23.068a3.233,3.233,0,0,1-3.229-3.229V23.173a3.232,3.232,0,0,1,3.229-3.228h8.454a3.232,3.232,0,0,1,3.228,3.228v8.348A3.232,3.232,0,0,1,31.522,34.75Zm-8.454-12.3a.73.73,0,0,0-.729.728v8.348a.73.73,0,0,0,.729.729h8.454a.73.73,0,0,0,.728-.729V23.173a.729.729,0,0,0-.728-.728Z"/><path d="M27.3,15.055a7.4,7.4,0,1,1,7.455-7.4A7.437,7.437,0,0,1,27.3,15.055Zm0-12.3a4.9,4.9,0,1,0,4.955,4.9A4.935,4.935,0,0,0,27.3,2.75Z"/></svg> 
                    <span class="mx-3">Categories</span>
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
            <section class="p-8 antialiased md:py-16">
                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                    <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Categories</h2>
                        <button id="add_categorie_button" class="text-gray-100 bg-gray-900 hover:bg-gray-700 p-3 mb-5 mr-5 rounded-sm">Add Categorie</button>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <?php foreach ($categories as $category): ?>
                            <div class="category_box flex flex-col rounded-lg border border-gray-200 bg-white px-4 py-4 hover:bg-gray-50" data-category-id="<?= $category['id_categorie']?>">
                                <h3 class="text-xl font-semibold text-gray-900 sm:text-2xl text-center"><?= $category['nom_categorie']?></h3>
                                <div class="flex justify-between my-4">
                                    <h3 class="font-semibold text-gray-900">Subcategories:</h3>
                                    <button type="button" class="add_sub_cat" title="Add subcategory" id="add_sub_category">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Display subcategories if they exist -->
                                <div id="sub_cats_container">
                                    <?php if (!empty($category['sous_categories'])): ?>
                                            <?php foreach ($category['sous_categories'] as $subCategory): ?>
                                                <div class="sub_cat_box ml-2 border-2 border-gray-200 px-2 py-1 mb-2 rounded-lg flex justify-between" data-sub-category-id="<?= $subCategory['id_sous_categorie'] ?>">
                                                    <span class="sub_cat_name"><?= htmlspecialchars($subCategory['nom_sous_categorie']) ?></span>
                                                    <div class="flex">
                                                        <button class="modify_sub_cat">
                                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        </button>
                                                        <form action="categories.php" method="POST">
                                                            <input type="text" value="<?= $subCategory['id_sous_categorie'] ?>" class="hidden" name="id_sub_categorie">
                                                            <button type="submit" class="remove_sub_cat ml-2" name="delete_sub_category">
                                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 7V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V7" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                            </button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                                
                                            <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="mt-2 text-sm text-gray-500">No subcategories available.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="flex justify-between items-end mt-auto mx-2 pt-5">
                                    <button class="modify_category_button">Modify</button>
                                    <!-- delete category -->
                                    <form action="categories.php" method="POST">
                                        <input type="text" value="<?= $category['id_categorie']?>" class="hidden" name="id_categorie">
                                        <input type="submit" value="Delete" name="delete_categorie">
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </section>
            </main>
        </div>
    </div>
</div>

<!-- Add and Modify Category Popup -->
<div id="categorie_modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
    <div id="add_modal_content" class="flex flex-col w-11/12 md:w-5/12 overflow-y-auto scrollbar-hidden mx-auto mt-10 p-4 bg-gray-200 rounded-sm shadow-lg">
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Add Category</h1>
            <!-- Close Icon -->
            <button id="close_categorie_modal" class="flex justify-end items-center mb-4 float-right text-xl">&times;</button>
        </div>
        <!-- add and modify categorie Form -->
        <form method="POST" action="categories.php" id="category_form" class="mt-[25%] md:px-10 hidden">
            <div class="flex w-full">
                <label for="category_name_input" class="text-gray-900 font-semibold w-1/3">Category Name:</label>
                <input type="text" class="hidden" name="category_id_input" value="0" id="category_id_input">
                <input type="text" name="category_name_input" id="category_name_input" value="" class="w-2/3" required>
            </div>
            
            <div class="flex justify-evenly">
                <input type="submit" name="add_modify_category" class="text-gray-100 bg-gray-700 border-2 border-gray-700 hover:bg-gray-900 px-8 py-1 mt-20 mr-6 float-right rounded-sm" value="Save">
            </div>
        </form>
        <!-- add and modify subcategorie Form -->
        <form method="POST" action="categories.php" id="sub_category_form" class="mt-[25%] md:px-10 hidden">
            <div class="flex w-full">
                <label for="subcategory_name_input" class="text-gray-900 font-semibold w-1/3">SubCategory Name:</label>
                <input type="text" class="hidden" name="category_parent_id_input" value="0" id="category_parent_id_input">
                <input type="text" class="hidden" name="subcategory_id_input" value="0" id="subcategory_id_input">
                <input type="text" name="subcategory_name_input" id="subcategory_name_input" value="" class="w-2/3" required>
            </div>
            
            <div class="flex justify-evenly">
                <input type="submit" name="add_modify_subcategory" class="text-gray-100 bg-gray-700 border-2 border-gray-700 hover:bg-gray-900 px-8 py-1 mt-20 mr-6 float-right rounded-sm" value="Save">
            </div>
        </form>
    </div>
</div>


<script>
    const modal = document.getElementById('categorie_modal');
    document.getElementById('close_categorie_modal').onclick = () => closeModal();
    // show modal as add category
    document.getElementById('add_categorie_button').onclick = () => {
        showModal();
        document.getElementById('category_form').classList.remove("hidden");
    }
    // show modal as add modify subcategory
    const modifyCategoryButtons =document.querySelectorAll(".modify_category_button");

    modifyCategoryButtons.forEach(modifyCategoryButton=>{
        modifyCategoryButton.onclick = () => {
        showModal();
        document.getElementById('category_form').classList.remove("hidden");
        document.getElementById("category_id_input").value=modifyCategoryButton.closest(".category_box").getAttribute("data-category-id");                
        document.getElementById("category_name_input").value=modifyCategoryButton.closest(".category_box")?.querySelector("h3").textContent;
        
    }
    });

    // show modal as add subcategory
    const addSubCategoryButtons =document.querySelectorAll(".add_sub_cat");
    addSubCategoryButtons.forEach(addSubCategoryButton=>{
        addSubCategoryButton.onclick = () => {
        showModal();
        document.getElementById('sub_category_form').classList.remove("hidden");       
        document.getElementById("category_parent_id_input").value=addSubCategoryButton.closest(".category_box").getAttribute("data-category-id");                        
    }
    });

    // show modal as modify subcategory
    const modifySubCategoryButtons =document.querySelectorAll(".modify_sub_cat");
    modifySubCategoryButtons.forEach(modifySubCategoryButton=>{
        modifySubCategoryButton.onclick = () => {
        showModal();
        document.getElementById('sub_category_form').classList.remove("hidden");       
        document.getElementById("category_parent_id_input").value=modifySubCategoryButton.closest(".category_box").getAttribute("data-category-id");
        document.getElementById("subcategory_id_input").value=modifySubCategoryButton.closest(".sub_cat_box").getAttribute("data-sub-category-id");
        document.getElementById("subcategory_name_input").value=modifySubCategoryButton.closest(".sub_cat_box")?.querySelector("span").textContent;
    }
    });

    function showModal(){
        modal.classList.remove('hidden');
    }
    function closeModal(){
        modal.classList.add('hidden');
        document.getElementById('category_form').classList.add("hidden");
        document.getElementById('sub_category_form').classList.add("hidden");
    }

    
</script>
<script data-cfasync="false" src="https://www.creative-tim.com/twcomponents/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8e2ed63ffe793144","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2024.10.5","token":"1b7cbb72744b40c580f8633c6b62637e"}' crossorigin="anonymous"></script>
</body>
</html>
