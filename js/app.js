
const height = "100vh"

// OPEN LOGOUT MODAL
const openModal = ()=>{
    const modal = document.querySelector(".logout-modal")
    const body = document.querySelector("body")

    modal.style.display = 'flex'
    body.classList.add('overflow')
}

// CLOSE LOGOUT MODAL
const closeModal = ()=>{
    const modal = document.querySelector(".logout-modal")
    const body = document.querySelector("body")

    const height = ""
    modal.style.display = 'none'
    body.classList.remove('overflow')
}


// OPEN USER PAGES
const dashboardHome = document.getElementById('dashboard-homepage')
const userProfile = document.getElementById('user-profile')
const deposit = document.getElementById('deposit')
const withdraw = document.getElementById('withdraw')
const transaction= document.getElementById('transaction')
const sideNav = document.querySelector('aside')

const openDashboardHome = ()=>{
    dashboardHome.style.display ='block'
    userProfile.style.display ='none'
    deposit.style.display ='none'
    withdraw.style.display ='none'
    transaction.style.display = 'none'
    sideNav.classList.add('slide-out-nav')
    sideNav.classList.remove('slide-in-nav')
    const body = document.querySelector("body");
    body.classList.remove("height");
}

const openProfile = ()=>{
    dashboardHome.style.display ='none'
    userProfile.style.display ='flex'
    deposit.style.display ='none'
    withdraw.style.display ='none'
    transaction.style.display = 'none'
    sideNav.classList.add('slide-out-nav')
    sideNav.classList.remove('slide-in-nav')
        const body = document.querySelector("body");
        body.classList.remove("height");
}

const openDeposit = ()=>{
    dashboardHome.style.display ='none'
    userProfile.style.display ='none'
    deposit.style.display ='flex'
    withdraw.style.display ='none'
    transaction.style.display = 'none'
    sideNav.classList.add('slide-out-nav')
    sideNav.classList.remove('slide-in-nav')
        const body = document.querySelector("body");
        body.classList.remove("height");
}

const openWithdraw =()=>{
    dashboardHome.style.display ='none'
    userProfile.style.display ='none'
    deposit.style.display ='none' 
    withdraw.style.display ='flex'
    transaction.style.display = 'none'
    sideNav.classList.add('slide-out-nav')
    sideNav.classList.remove('slide-in-nav')
        const body = document.querySelector("body");
        body.classList.remove("height");
}

const openTransaction =()=>{
    dashboardHome.style.display ='none'
    userProfile.style.display ='none'
    deposit.style.display ='none' 
    withdraw.style.display ='none'
    transaction.style.display = 'flex'
    sideNav.classList.add('slide-out-nav')
    sideNav.classList.remove('slide-in-nav')
        const body = document.querySelector("body");
        body.classList.remove("height");
}


const nextOPtion = ()=>{
    const depositForm = document.getElementById("form-submit")
    const chooseplan = document.getElementById("choose-plan")

    depositForm.classList.remove('display-none')
    chooseplan.classList.add('display-none')

}

const viewPackage =()=>{
    const depositForm = document.getElementById("form-submit")
    const chooseplan = document.getElementById("choose-plan")

    depositForm.classList.add('display-none')
    chooseplan.classList.remove('display-none')
}

const openSideNav = () => {
  const body = document.querySelector("body");

  function createCSSRule() {
    var style = document.createElement("style");
    style.appendChild(document.createTextNode(""));
    document.head.appendChild(style);
    return style.sheet;
  }

  var stylesheet = createCSSRule();
  stylesheet.insertRule(".height { height: 100vh; overflow: hidden; }", 0);

    body.classList.add("height");
    
    console.log(body)

  sideNav.style.display = "block";
  sideNav.style.width = "100%";
  sideNav.style.height = "100vh";
  sideNav.classList.add("slide-in-nav");
  sideNav.classList.remove("slide-out-nav");
}







