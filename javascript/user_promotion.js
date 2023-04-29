const userBoxes = document.querySelectorAll('.user-box')

userBoxes.forEach((element) => {
    const id = element.querySelector('.uid')
    const uid = id.getAttribute('value')

    const button = element.querySelector('.user-promotion-button')
    button.addEventListener('input', async function(value) {
        const response = await fetch('../api/api_users.php?uid=' + uid + '&level=' + value)
        const content = await response.json()

        if (json.success === "0") {
            element.style.backgroundColor = "red"
        } 
        else {
            element.style.backgroundColor = "white"
        }
    })
})