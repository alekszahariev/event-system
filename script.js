let phone_input = document.querySelector(".phone_number")
let check_button = document.querySelector(".check-button")

phone_input.addEventListener("change", function() {
    let input = phone_input.value.replace(/\s/g, '');
    let trimmedValue;
    if (input.startsWith('359')) {
        trimmedValue = '0' + input.slice(3);
    } else if (input.startsWith('+359')) {
        trimmedValue = '0' + input.slice(4);
    } else if (input.startsWith('00359')) {
        trimmedValue = '0' + input.slice(5);
    }
    else {
        trimmedValue = input;
    }

    phone_input.value = trimmedValue;
});

$(document).ready(function() {
    $('.check-button').on('click', function() {
        var phoneValue = phone_input.value
       
        // Make AJAX call
        $.ajax({
            url: './php/check_phone.php',
            type: 'POST',
            data: { phone:phoneValue },
            success: function(response) {
                
                if (response === 'exists') {
                   showForm(phone_input.value)
                } else {
                    alert('Този телефон не съществува в нашата база данни. Ако смяташ, че е грешка звънни тук: 0897858684. А за по-бързо погледни емайла с който си направил поръчка. Намери емайла за потвърждение на поръчката и виж да не си объркал някоя цифра.');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Има грешка в системата. Звъннете тук: 0897858684');
            }
        });
    });
});

function showForm(phone){
    
    $.ajax({
        url: './php/check_answer.php',
        type: 'POST',
        data: { phone:phone },
        success: function(response) {
            
            if (response === 'not_exists') {
                renderDiv()
            } else {
                answerGiven(response) 
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Има грешка в системата. Звъннете тук: 0897858684');
        }
    });

    function renderDiv(){
        let div = document.querySelector(".phone-check")
        div.innerHTML = 
        `
        <form action="./index.php" method="post">
        <div class="input-group">
            <span>Име:</span>
            <input maxlength="10" type="text" class="form-control" name="name" placeholder="Име" id="" required>
        </div>
    
        <div class="input-group">
            <span>Телефон:</span>
            <input type="text" class="form-control" name="instagram" value="${phone}" placeholder="${phone}" readonly>
        </div>
        
        <div class="input-group">
            <span>Паролата за телефона на детектива:</span>
            <input type="text" class="form-control" name="firstword" placeholder="Парола за телефона:" id="" required>
        </div>
    
        <div class="input-group">
            <span>Е-Майл парола</span>
            <input type="text" class="form-control" name="secondword" placeholder="Е-Майл Парола" id="" required>
        </div>
       
        <div class="input-group">
            <span>ИП на предполагаемия убиец:</span>
            <input type="text" class="form-control" name="thirdword" placeholder="ИП на предполагаемия убиец:" id="" required>
        </div>
    
        <div class="input-group">
            <span>Напиши твоето решение на случая и защо мислиш така.</span>
            <textarea style="width:100%" name="answer" id="" cols="30" rows="10" required></textarea>
        </div>
    
        <button type="submit" class="submit">Изпрати</button>
        </form>
        `
    }
   
}

function answerGiven(id){
    let div = document.querySelector(".phone-check")
    div.style.background = "red";
    div.innerHTML = 
    `
        <h2 class="text-center">Вече си дал отговор</h2>
        <p class="text-center">Твоето ID:${id} </p>

    `
}