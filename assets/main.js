$('.create-form').submit(function(e){
    e.preventDefault();   

    let form = $(this);
    let data = {};
    let name = form.find('input[name="name"]').val()
    let preparation = form.find('input[name="preparation"]').is(':checked');
    let category = form.find('select[name="category"]').val()

    data.name = name;
    data.preparation = preparation;
    data.category = category;

   
    let objJ = JSON.stringify(data);    
    
    $.ajax({
        url: 'app.php?r=tricks/create',
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