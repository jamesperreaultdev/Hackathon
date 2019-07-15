var naughty = ['damn','shit','fuck','goddamnit','ass','dick','prick','slut','whore','bellend','cunt','nigg']; 
// var naughty = ['hello','how are you','hi','whats up','hey']
//random: var naughty = ['small','dog', 'Chip Skylark,''Rwanada,'tango','metallurgy']
var counter = 0;

function censor(elem,oldtext,newtext,){
    var reg_replace = new RegExp(oldtext,"gi")
    for(var i = 0; i<elem.length;i++){
    var element = elem[i];

        for(var j=0;j<element.childNodes.length;j++){
           var node = element.childNodes[j];
                
                if(node.nodeType === 3) {   
                var text = node.nodeValue;
                var replacementText = text.replace(reg_replace,newtext) 
                }
                
                if(replacementText !== text){
                counter++;
                element.replaceChild(document.createTextNode(replacementText),node);
            }

    }
  }
}

    for(x=0;x<naughty.length;x++){
var elements =document.getElementsByTagName('*');
        censor(elements,naughty[x],"--");
    }
    
 window.wordText = counter;
 alert(counter);
