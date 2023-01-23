const cookieBox = document.querySelector('#cookieContainer'), buttons = document.querySelectorAll('.buttonCookie');

const executeCodes = () => {
    //If cookie contains Artichaude it will be returned and below of this code will not run
    if(document.cookie.includes('memorisedArtichaude')) return;

    cookieBox.classList.add('show');
    buttons.forEach((button) => {
        button.addEventListener('click', () => {

            cookieBox.classList.remove('show');

            //If button has acceptBtn id
            if(button.id == "acceptBtn") {
                //Set cookie for 1h
                document.cookie = "cookieFrom= memorisedArtichaude; max-age=" + 300;
            }
        });
    });
};

window.addEventListener("load", executeCodes);

  
