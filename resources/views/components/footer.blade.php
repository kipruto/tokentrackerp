<!-- script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function filterTimesheets() {
            const sortBy = document.getElementById('sortBy').value;
            const approved = document.getElementById('approvedFilter').value;
            const status = document.getElementById('statusFilter').value;

            // Build query parameters
            const params = new URLSearchParams();
            if (sortBy) params.append('sort_by', sortBy);
            if (approved && approved !== 'all') params.append('approved', approved);
            if (status && status !== 'all') params.append('status', status);

            // Redirect to the same page with query parameters
            window.location.search = params.toString();
        }

        const ModalButton = document.getElementById('modalbutton');
        const modal = document.getElementById('modalpopup');

        ModalButton.addEventListener('click', () => {
            event.stopPropagation();
            modal.classList.remove('hidden'); // Show the modal
        });

        const isClickInside = modal.contains(event.target) || ModalButton.contains(event.target);

        if (!isClickInside) {
            modal.classList.add("hidden");
        }

    });

</script>





</html>