

function showHideList(caller) {
    if(caller != null)
    {
        let parent = caller.parentNode;
        let list = parent.childNodes;


        for(const node of list)
        {
            if(node != null) {
                console.log("node");
                console.log(node.classList.contains("yadm-dash-system-list-table-container"));
            }
        }

        let table = list.lastChild;

        switch (table.style.display) {
            case 'none':
                table.style.display = "block";
                break;
            default:
                table.style.display = "none";
        }
    }
}

function showHideID(id) {
    let element = document.getElementById(id);
    switch (element.style.display) {
            case 'none':
                element.style.display = "block";
                break;
            default:
                element.style.display = "none";
        }
}