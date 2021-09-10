<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-4"><h2>Списък с пациенти</h2></div>
        <div class="col-md-5"></div>
        <div class="col-md-3"></div>

    </div>
    <table id="users_table" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Име</th>
                <th>Фамилия</th>
                <th>Идентификатор</th>
                <th>Рождена дата</th>
                <th>Редакция</th>
                <th>Рецепта</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($patients as $patient) { ?>
            <tr>
                <td><?php echo $patient['ID'] ?></td>
                <td><?php echo $patient['FNAME'] ?></td>
                <td><?php echo $patient['LNAME'] ?></td>
                <td><?php echo $patient['IDENTIFIER'][0].$patient['IDENTIFIER'][1].$patient['IDENTIFIER'][2].$patient['IDENTIFIER'][3].'******' ?></td>
                <td><?php echo $patient['BIRTHDATE'] ?></td>
                <td>
                    <button type="button" onclick="document.location='edit?userID=<?php echo $patient['ID']?>'" class="btn btn-outline-dark"">
                        <i class="bi bi-file-person" style="font-size: 1rem; padding-right: 3px;"></i>Редакция
                    </button>
                </td>
                <td>
                    <button type="button" onclick="document.location='/eprescription/index?id=<?php echo $patient['ID'] ?>'" class="btn btn-outline-danger">
                        <i class="bi bi-card-list" style="font-size: 1rem; padding-right: 5px;"></i>Рецепта
                    </button>    
                <td hidden><?php echo $patient['IDENTIFIER']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript" class="init">
            $(document).ready(function() {
                $('#users_table').DataTable({
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