<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-4"><h2>Списък с рецепти</h2></div>
        <div class="col-md-5"></div>
        <div class="col-md-3"></div>

    </div>
    <table id="prescriptions_table" >
        <thead>
            <tr>
                <th>Дата</th>
                <th>Име</th>
                <th>Фамилия</th>
                <th>Преглед</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($prescriptions as $prescription) {  ?>
            <tr>
                <td><?php echo $prescription->DATE; ?></td>
                <td><?php echo $prescription->FNAME; ?></td>
                <td><?php echo $prescription->LNAME; ?></td>
                <td><a class="btn btn-secondary" href="/eprescription/view?prescription_id=<?php echo $prescription->PRESCR_ID;  ?>">Преглед</a>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" class="init">
            $(document).ready(function() {
                $('#prescriptions_table').DataTable({
//                    "bFilter": false,
                    "ordering": false,
                    "pageLength": 100,
                    language: {
                        "sProcessing":   "Обработка на резултатите...",
                        "sLengthMenu":   "Показване на _MENU_ резултата",
                        "sZeroRecords":  "Няма намерени резултати",
                        "sInfo":         "Показване на резултати от _START_ до _END_ от общо _TOTAL_",
                        "sInfoEmpty":    "Показване на резултати от 0 до 0 от общо 0",
                        "sInfoFiltered": "(филтрирани от общо _MAX_ резултата)",
                        "sInfoPostFix":  "",
                        "sSearch":       "Търсене",
                        "sUrl":          "",
                        "searchPlaceholder": "Търсене в таблицата",
                        "oPaginate": {
                            "sFirst":    "Първа",
                            "sPrevious": "Предишна",
                            "sNext":     "Следваща",
                            "sLast":     "Последна"
                        }
                    }
                });
            });
	</script>