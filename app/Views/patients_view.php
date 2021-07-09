<div class="container" style="padding-top: 50px;">
    <table id="users_table" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Име</th>
                <th>Фамилия</th>
                <th>Идентификатор</th>
                <th>Рождена дата</th>
                <th></th>
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
                <td><a class="btn btn-secondary" href="/eprescription/index?id=<?php echo $patient['ID'] ?>">Рецепта</a></td>
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