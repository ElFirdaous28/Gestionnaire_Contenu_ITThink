<!-- Add Offer Popup -->
<div id="offer_modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
    <div id="modal_content" class="flex flex-col w-11/12 md:w-5/12 overflow-y-auto scrollbar-hidden mx-auto mt-10 p-4 bg-gray-200 rounded-sm shadow-lg">
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Offre</h1>
            <!-- Close Icon -->
            <button id="close_offer_modal" class="flex justify-end items-center mb-4 float-right text-xl">&times;</button>
        </div>
        <!-- Add Offer Form -->
        <form method="POST" action="../controllers/offres/add_modify_offer.php" id="offer_form" class="mt-[25%] md:px-10">
            <!-- Montant Field -->
            <div class="flex w-full mb-4">
                <label for="montant_input" class="text-gray-900 font-semibold w-1/3">Montant (€):</label>
                <input type="number" name="montant_input" id="montant_input" value="" class="w-2/3 border-gray-300 rounded-md" required>
            </div>

            <!-- Délai Field -->
            <div class="flex w-full mb-4">
                <label for="delai_input" class="text-gray-900 font-semibold w-1/3">Délai (Date et Heure):</label>
                <input type="datetime-local" name="delai_input" id="delai_input" value="" class="w-2/3 border-gray-300 rounded-md" required>
            </div>

            <input type="text" class="" name="project_id_input" value="0" id="project_id_input">
            <!-- offre input in case of modify -->
            <input type="text" class="" name="offre_id_input" value="0" id="offre_id_input">

            <div class="flex justify-end">
                <input type="submit" name="add_offre" class="text-gray-100 bg-gray-700 border-2 border-gray-700 hover:bg-gray-900 px-8 py-1 mt-6 rounded-sm" value="Add Offre">
            </div>
        </form>
    </div>
</div>

<script>
    const offerModal = document.getElementById('offer_modal');
    const closeOfferModal = document.getElementById('close_offer_modal');

    // Show modal as add offer
    const submitOffreButtons = document.querySelectorAll('.submit_offre_button');
    submitOffreButtons.forEach(submitOffreButton => {
        submitOffreButton.addEventListener('click', () => {
            offerModal.classList.remove('hidden');
            document.getElementById("project_id_input").value = submitOffreButton.getAttribute("data-project-id");
        });
    });

    // Show modal as modify offer
    const modifyOffreButtons = document.querySelectorAll('.modify_offre_button');
    modifyOffreButtons.forEach(modifyOffreButton => {
        modifyOffreButton.addEventListener('click', () => {
            offerModal.classList.remove('hidden');
            document.getElementById("montant_input").value = modifyOffreButton.closest("tr").querySelector(".offre_montant").textContent;
            document.getElementById("delai_input").value = modifyOffreButton.closest("tr").querySelector(".offre_deali").textContent;
            document.getElementById("offre_id_input").value = modifyOffreButton.getAttribute("data-offre-id");
        });
    });

    // Close modal when clicking on the close button
    closeOfferModal.addEventListener('click', () => {
        offerModal.classList.add('hidden');
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', (event) => {
        if (event.target === offerModal) {
            offerModal.classList.add('hidden');
        }
    });
</script>