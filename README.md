# CLI-lib Test Task
Тестовое задание от 22.01.2021

/src/app_data/ - приложение использующее CLI-библиотеку. <br>
/src/cli_lib/ - CLI-библиотека. <br>
app.php - точка входа. <br>
<br>
Назначение и функционал классов, интерфейсов и методов прокомментированы непосредственно в коде. <br>
Для автолоада классов используется PSR-4 через composer. <br>
Название демо-команды для последней части задания - demo_command. <br>
<br>
Пример вызова: <br>
<br>
php app.php demo_command {verbose,overwrite} [log_file=app.log] {unlimited} [methods={create,update,delete}] [paginate=50] {log}
