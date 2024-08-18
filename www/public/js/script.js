$(document).ready(function () {

    /**
     * nikto datatables
     */
    $('#nikto_datatables').DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        pageLength: 15,
        order: [[4, 'desc']]
    });

    /**
     * nmap datatables
     */
    $('#nmap_datatables').DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        pageLength: 15,
        order: [[5, 'desc']]
    });

    /**
     * user datatables
     */
    $('#user_datatables').DataTable({
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        pageLength: 15,
        order: [[3, 'desc']]
    });

    /**
     * when user choose the active host scan type,
     * show a new form to input subnets
     */
    $('#scan-type').on('change', function () {
        if ($(this).val() === 'Hosts') {
            const newForm = `
                <div class="col-md-3 mb-3">
                    <input type="input" class="form-control" name="subnet_ip_range" placeholder="Enter Subnet">
                </div>
            `;
            $('#new-form-container').html(newForm);
        } else {
            $('#new-form-container').html('');
        }
    });

    /**
     * sidebar toggle
     */
    $('[data-bs-toggle="collapse"]').on('click', function () {
        $(this).find('.chevron-icon').toggleClass('fa-chevron-down fa-chevron-up');
    });

    /**
     * display alert scanning in progress...
     */
    $('#btn-tools').on('click', function () {
        $('#scan-alert').removeClass('d-none');

        var periods = '';
        var intervalId = setInterval(function () {
            periods += '.';
            if (periods.length > 3) {
                periods = '';
            }
            $('#scan-alert').text('Scanning in progress' + periods);
        }, 500);
    });
});
