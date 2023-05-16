const priorityBoxes = document.querySelectorAll('.priority-box')

priorityBoxes.forEach((element) => {
    const tID = element.querySelector('.tid').value
    const priorityValue = element.querySelector('.priority')
    const csrf = element.querySelector('.csrf').value
    const incrementButton = element.querySelector('.increment-priority')
    const decrementButton = element.querySelector('.decrement-priority')

    incrementButton.addEventListener('click', async function () {
        const priority = parseInt(priorityValue.value, 10) + 1
        const response = await fetch('../api/api_change_priority.php?priority=' + priority + '&id=' + tID + '&csrf=' + csrf)
        const json = await response.json()
        priorityValue.value = json
        updatePriorityColor(priorityValue)
    })

    decrementButton.addEventListener('click', async function () {
        const priority = parseInt(priorityValue.value, 10) - 1
        const response = await fetch('../api/api_change_priority.php?priority=' + priority + '&id=' + tID + '&csrf=' + csrf)
        const json = await response.json()
        priorityValue.value = json
        updatePriorityColor(priorityValue)
    })

    // Chama a função inicialmente para definir a cor correta
    updatePriorityColor(priorityValue)
})

function updatePriorityColor(priorityElement) {
    const priorityValue = parseInt(priorityElement.value)

    const priority_button_1 = document.querySelector('.increment-priority');
    const priority_button_2 = document.querySelector('.decrement-priority');


    // Adiciona a classe de cor correspondente ao nível de prioridade
    if (priorityValue === 0) {
        priority_button_1.style.backgroundColor = '#008000bf';
        priority_button_2.style.backgroundColor = '#008000bf';
    } else if (priorityValue === 1) {
        priority_button_1.style.backgroundColor = '#ffff00b3';
        priority_button_2.style.backgroundColor = '#ffff00b3';
    } else if (priorityValue === 2) {
        priority_button_1.style.backgroundColor = '#ffa500ba';
        priority_button_2.style.backgroundColor = '#ffa500ba';
    } else if (priorityValue === 3) {
        priority_button_1.style.backgroundColor = '#ff0000ba';
        priority_button_2.style.backgroundColor = '#ff0000ba';
    }
}
