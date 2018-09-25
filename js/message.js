function getMessage(name, callback){
    let tab = {
        operation: 'get',
        name: name
    }
    // console.log(tab);
    $.post("operationMessage.php", tab, function(data){
        // console.log(data);
        try {
            let json = JSON.parse(data);
            // console.log(json);
            callback(json);
            return json;           
        } catch (error) {
            // console.log(error);
        }
    }).fail(function(data){
        console.log(data)
    });
}

function saveMessage(name, text, turn){
    let tab = {
        operation: 'save',
        text: text,
        turn: turn,
        name: name
    }
    console.log(tab);
    $.post("operationMessage.php", tab, function(data){
        // console.log(data);
    }).fail(function(data){
        // console.log(data.responseText);
    });
}