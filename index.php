<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1><?php echo "This is main page"?></h1>

    <form class="create-form">
        <fieldset>
            <legend>Поля для заполнения:</legend>            
            <label>Название <input class="" type="text" name="name"></label>
            <p>Подготовка</p>            
            <label>Да <input class="r2d2" type="checkbox" name="preparation"></label>
            
        </fieldset>
        <fieldset>
            <legend>Раздел для заполнения</legend>
            <select name="category" id="category">
                <option value="tricks">Фокусы</option>
                <option value="decks">Колоды</option>
            </select>           
            <button class="create-form__btn" type="submit">Создать</button>
        </fieldset>
        
    </form>

<br>
    <button class="list" type="button">See all</button>
    <br><br>
    <form class="search">
        <input class="search__input" type="text" placeholder="Type id">
        <button type="submit">Show</button>
    </form>

    <script src="./assets/jquery-3.4.1.min.js"></script>
    <script src="./assets/main.js"></script>
</body>
</html>