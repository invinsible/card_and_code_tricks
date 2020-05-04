<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>    
    <div class="container"> 
        <div class="form-wrapper">
            <h1>Create Tricks</h1>
            <form class="create-form">
                <fieldset>
                    <legend>Category</legend>
                    <select name="category" id="category">
                        <option value="tricks">Tricks</option>
                        <option value="decks">Decks</option>
                    </select>
                </fieldset>
                <fieldset>                    
                    <div class="create-form__row">
                        <label class="create-form__label" for="name">Name</label> 
                        <input class="create-form__input" type="text" name="name" id="name" autocomplete="off"> 
                    </div>            
                    <div class="create-form__row">
                        <label class="create-form__label" for="preparation">Preparation</label>
                        <input type="checkbox" name="preparation" id="preparation">
                    </div>  
                    <div class="create-form__row">
                        <p class="create-form__label">Difficult</p>
                        <label>Light <input type="radio" name="difficult" value="light"></label>
                        <label>Normal <input type="radio" name="difficult" value="normal"></label>
                        <label>Hard <input type="radio" name="difficult" value="hard"></label>                        
                    </div>                
                    <div class="create-form__row">
                        <label class="create-form__label" for="steps">Steps</label>
                        <textarea class="create-form__input" name="steps" rows="4" id="steps"></textarea>
                    </div> 
                    <div class="create-form__row">
                        <label class="create-form__label" for="video_link">Video</label>
                        <input class="create-form__input" type="text" name="video_link" id="video_link" autocomplete="off">
                        
                        <label class="create-form__label" for="video_author">Author video</label>
                        <input class="create-form__input" type="text" name="video_author" id="video_author" autocomplete="off">
                    </div>
                    <div class="create-form__row">
                        <label class="create-form__label" for="views">Views</label>
                        <input class="create-form__input" type="number" name="views" id="views" autocomplete="off">
                    </div>
                    <div class="create-form__row">
                        <label class="create-form__label" for="comment">Дополнительно</label>
                        <textarea class="create-form__input" name="comment" rows="4" id="comment"></textarea>
                    </div>                   


                    <button class="btn create-form__btn" type="submit">Save</button>
                </fieldset>
            </form>
        </div>

        <div class="form-wrapper">
            <button class="showlist" type="button">See all</button>
            <ul class="list"></ul>
        </div>
    </div>
    

<!-- <br>
    <button class="list" type="button">See all</button>
    <br><br>
    <form class="search">
        <input class="search__input" type="text" placeholder="Type id">
        <button type="submit">Show</button>
    </form> -->

    <script src="./assets/jquery-3.4.1.min.js"></script>
    <script src="./assets/main.js"></script>
</body>
</html>