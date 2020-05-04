$('.create-form').submit(function(e){
    e.preventDefault();

    let form = $(this);
    let category = form.find('select[name="category"]').val()
    let data = {};

    //Collect values
    let name = form.find('[name="name"]').val()
    let preparation = form.find('[name="preparation"]').is(':checked');
    let difficult = form.find('[name="difficult"]:checked').val();
    let steps = form.find('[name="steps"]').val();
    let videoLink = form.find('[name="video_link"]').val();    
    let videoAuthor = form.find('[name="video_author"]').val();
    let views = form.find('[name="views"]').val();
    let comment = form.find('[name="comment"]').val();

    data.name = name;
    data.preparation = preparation;
    data.difficult = difficult;
    data.steps = steps;
    data.video_link = videoLink;
    data.video_author = videoAuthor;
    data.views = views;
    data.comment = comment;
   
    let objJ = JSON.stringify(data);    
    
    $.ajax({
        url: `app.php?r=${category}/create`,
        method: 'POST',
        data: objJ,
        dataType: 'json',          
        processData: false,
        contentType: 'application/json',
        success: function(result){
            console.log(result);
        }
    });
    
});

$('.showlist').click(function(e){
    e.preventDefault(); 

    loadList('tricks');
});


$('.search').submit(function(e){
    e.preventDefault(); 
    let val = $('.search__input').val();

    $.ajax({
        url: `app.php?r=tricks/getOne&id=${val}`,
        method: 'GET',        
        dataType: 'json',
        success: function(result){
            console.log(result);
        }
    });
});

// Delete item
$('body').on('click', '.del', function(e) {
    e.preventDefault(); 

    let parent = $(this).parent();
    let id = parent.data('id');

    $.ajax({
        url: `app.php?r=tricks/delete&id=${id}`,
        method: 'GET',        
        dataType: 'json',
        success: function(result){
            loadList('tricks');
        }
    });
    
});

function loadList (category) {
    $.ajax({
        url: `app.php?r=${category}/getList`,
        method: 'GET',        
        dataType: 'json',
        success: function(result){
            updateList(result);        
        }
    });
};

function updateList (obj) {
    let list = $('.list');
    let arr = obj.data;    
    list.html('');
   
    arr.forEach(element => {                
        let template = `
        <li class="list__item" data-id="${element.id}">
            <a class="list__link" href="${element.id}">${element.name}</a>
            <button class="btn upd">Update</button>
            <button class="btn del">Delete</button>
        </li>
        `
        list.append(template);
    });
};

