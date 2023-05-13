const statusBoxes = document.querySelectorAll('.status-box')

statusBoxes.forEach((element) => {
    const tID = element.querySelector('.status-id').value
    const statusSelect = element.querySelector('select')
    const assignButton = element.querySelector('.status-confirm')

    assignButton.addEventListener('click', async function () {
        const response = await fetch('../api/api_change_status.php?status=' + statusSelect.value + '&id=' + tID)
        const json = await response.json()
        console.log(json)
    })
})