$('.create-form').submit(function(e){
    e.preventDefault();   

    let form = $(this);
    let category = form.find('select[name="category"]').val()
    let data = {};

    //Collect values
    let name = form.find('[name="name"]').val()
    let preparation = form.find('[name="preparation"]').is(':checked');
    let steps = form.find('[name="steps"]').val();
    let videoLink = form.find('[name="video_link"]').val();
    let videoAuthor = form.find('[name="video_author"]').val();
    let views = form.find('[name="views"]').val();
    let comment = form.find('[name="comment"]').val();

    data.name = name;
    data.preparation = preparation;
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

$('.list').click(function(e){
    e.preventDefault(); 

    $.ajax({
        url: 'app.php?r=tricks/getList',
        method: 'GET',        
        dataType: 'json',
        success: function(result){
            console.log(result);
        }
    });
});


$('.search').submit(function(e){
    e.preventDefault(); 
    let val = $('.search__input').val();

    $.ajax({
        url: 'app.php?r=tricks/getOne&id='+ val,
        method: 'GET',        
        dataType: 'json',
        success: function(result){
            console.log(result);
        }
    });
});