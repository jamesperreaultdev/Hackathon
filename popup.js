
function startcensor(){
    
    console.log("flag 1");
        chrome.tabs.executeScript(
            {file: 'censor.js'}
            );
     console.log("flag 2");       
    }



document.getElementById('clickactivity').addEventListener('click',startcensor)





