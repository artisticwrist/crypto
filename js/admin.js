

// CLOSE PAYMENT MODAL
const closePaymentModal = ()=>{
    const paymenModal = document.getElementById("payment-modal")

    paymenModal.classList.add("display-none")
}



// OPEN PAYMENT MODAL
const showPaymentModal = ()=>{
    const paymenModal = document.getElementById("payment-modal")

    paymenModal.classList.remove("display-none")
    paymenModal.style.display = 'flex';
}


const users = document.querySelector('.all-users');
const pendingUsers = document.querySelector('.pending-request');
const verifiedUseers = document.querySelector('.verified-users');

const allUsers = ()=>{
    pendingUsers.classList.add('display-none')
    verifiedUseers.classList.add('display-none')
    users.classList.remove('display-none')
}

const pendingRequest = ()=>{
    users.classList.add('display-none')
    pendingUsers.classList.remove('display-none')
    verifiedUseers.classList.add('display-none')
}

const verifiedUsers = ()=>{
    pendingUsers.classList.add('display-none')
    verifiedUseers.classList.remove('display-none')
    users.classList.add('display-none')
}

const upadteUser = ()=>{
    const update = document.querySelector('.update-user')
    pendingUsers.classList.add('display-none')
    verifiedUseers.classList.add('display-none')
    users.classList.add('display-none')

    update.classList.remove('display-none')

    console.log('hey')

}