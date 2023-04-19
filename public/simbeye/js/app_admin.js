document.addEventListener("DOMContentLoaded", function (event) {

    function sidebar(toggle , nav , bodypd , headerpd){
        nav.classList.remove('my-sidebar-hide', 'my-sidebar-show')
        bodypd.classList.remove('my-body-pd-hide','my-body-pd-show')
        headerpd.classList.remove('my-body-pd-hide','my-body-pd-show')
        if (localStorage.getItem('expandSideBar')=='true') {
            nav.classList.add('my-sidebar-show')
            bodypd.classList.add('my-body-pd-show')
            headerpd.classList.add('my-body-pd-show')
        } else {
            nav.classList.add('my-sidebar-hide')
            bodypd.classList.add('my-body-pd-hide')
            headerpd.classList.add('my-body-pd-hide')
        }
        // change icon
        // toggle.classList.toggle('bx-x')
    }

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)
        // localStorage.removeItem('expandSideBar')
        console.log(localStorage.getItem('expandSideBar'))
        if (localStorage.getItem('expandSideBar')==null) {
            localStorage.setItem('expandSideBar', 'true');
        }
        sidebar(toggle , nav , bodypd , headerpd)

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            // if (localStorage.getItem('expandSideBar')) {
            //     nav.classList.add('my-sidebar-show')
            // } else {
            //     nav.classList.add('my-sidebar-hide')
            // }
            toggle.addEventListener('click', () => {
                // show navbar
                // nav.classList.toggle('show')
                // let currentState = localStorage.getItem('expandSideBar');
                localStorage.setItem('expandSideBar', localStorage.getItem('expandSideBar')=='true'?'false':'true');
                console.log(localStorage.getItem('expandSideBar'))
                sidebar(toggle , nav , bodypd , headerpd)

                // add padding to body
                // bodypd.classList.toggle('body-pd')
                // add padding to header
                // headerpd.classList.toggle('body-pd')



            })
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready
});
