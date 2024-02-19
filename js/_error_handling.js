document.addEventListener('DOMContentLoaded' , function () {

        var URL_params = new URLSearchParams(window.location.search);
            
            setTimeout(() => {
                if( URL_params.get('ERROR') == '400') {
                    new_Alert( " Something went Wrong :( , Please try again");
                }
                if(URL_params.get('ACTION') == 'sign-in')    {
                    buttons[1].click();
                }
                if( (URL_params.get('ERROR') == '404') && (URL_params.get('USER')) ) {
                    new_Alert( "404 : Password is wrong!");
                    user.value = URL_params.get('USER');
                }else if(URL_params.get('ERROR') == '404') {
                    new_Alert( URL_params.get('ERROR') + " : User not Found!");
                }
                if(URL_params.get('ERROR') == '409') {
                    new_Alert( URL_params.get('ERROR') + " : Username conflicts , Please contect Admin or manager");
                }
                if(URL_params.get('ERROR') == '1146')    {
                    new_Alert( URL_params.get('ERROR') + " : DATABASE error , Please contect Admin or manager");
                }

                // succes status messages
                if(URL_params.get('SUCCESS') == '201')    {
                    new_notification("'" + URL_params.get('USER') + "' User Created Successfully.");
                    user.value = URL_params.get('USER');
                }
                if(URL_params.get('SUCCESS') == '202')    {
                    new_notification(" You have Successfully Logged Out.");
                }
                if(URL_params.get('SUCCESS') == '203')    {
                    new_notification(" Your Accout has Successfully Deleted.");
                }
            },10);
});