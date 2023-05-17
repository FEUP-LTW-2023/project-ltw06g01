const userBoxes = document.querySelectorAll('.user-box-popup')

userBoxes.forEach((element) => {
    const id = element.querySelector('.uid')
    const uid = id.getAttribute('value')

    const button = element.querySelector('.user-promotion')
    button.addEventListener('input', async function(e) {
        console.log('../api/api_users.php?uid=' + uid + '&level=' + e.target.value)
        const response = await fetch('../api/api_users.php?uid=' + uid + '&level=' + e.target.value)
        const content = await response.json()

        if (content.success === "0") {
            element.style.borderColor = "red"
        } 
        else {
            if (e.target.value === "0"){
                element.style.borderColor = "green"
            }
            if (e.target.value === "1"){
                element.style.borderColor = "orange"
            }
            if (e.target.value === "2"){
                element.style.borderColor = "red"
            }
        }
    })
})