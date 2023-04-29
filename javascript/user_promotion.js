const userBoxes = document.querySelectorAll('.user-box')

userBoxes.forEach((element) => {
    const id = element.querySelector('.uid')
    const uid = id.getAttribute('value')

    const button = element.querySelector('.user-promotion-button')
    button.addEventListener('input', async function(e) {
        console.log('../api/api_users.php?uid=' + uid + '&level=' + e.target.value)
        const response = await fetch('../api/api_users.php?uid=' + uid + '&level=' + e.target.value)
        const content = await response.json()

        if (content.success === "0") {
            element.style.backgroundColor = "red"
        } 
        else {
            element.style.backgroundColor = "white"
        }
    })
})