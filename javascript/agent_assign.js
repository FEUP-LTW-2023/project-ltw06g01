const assignBoxes = document.querySelectorAll('.assign-box')

assignBoxes.forEach((element) => {
    const tID = element.querySelector('.assign-id').value
    const agentSelect = element.querySelector('select')
    const assignButton = element.querySelector('.assign-confirm')

    assignButton.addEventListener('click', async function () {
        const response = await fetch('../api/api_assign_agent.php?aid=' + agentSelect.value + '&id=' + tID)
        const json = await response.json()
    })
})