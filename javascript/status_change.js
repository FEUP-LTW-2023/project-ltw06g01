const statusBoxes = document.querySelectorAll('.status-box')

statusBoxes.forEach((element) => {
    const tID = element.querySelector('.status-id').value
    const statusSelect = element.querySelector('select')
    const csrf = element.querySelector('.csrf').value
    const assignButton = element.querySelector('.status-confirm')

    assignButton.addEventListener('click', async function () {
        const params = {'status': statusSelect.value, 'id': tID, 'csrf': csrf}
        const response = await fetch('../api/api_change_status.php?' + new URLSearchParams(params).toString())
        const json = await response.json()

        if (json != statusSelect.value) {
            assignButton.style.backgroundColor = "red"
        }
        else {
            assignButton.style.backgroundColor = "green"
        }

        setTimeout(() => {
            assignButton.style.backgroundColor = "#bed9e041"
        }, 2000)
    })
})