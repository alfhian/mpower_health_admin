
//  Hide Accordion after select the option
function hideAccordion(name) {
    accordionBody = $('#' + name).parent().parent().attr('id');
    $('#' + accordionBody).removeClass('show')
    accordionHeading = $('#' + name).parent().parent().attr('aria-labelledby')
    $('#' + accordionHeading + ' button').addClass('collapsed').attr('aria-expanded', 'false')
    $('#' + accordionHeading + ' button span').show()
}

function showAccordion(name) {
    accordionBody = $('#' + name).parent().parent().attr('id');
    $('#' + accordionBody).addClass('show')
    accordionHeading = $('#' + name).parent().parent().attr('aria-labelledby')
    $('#' + accordionHeading + ' button').removeClass('collapsed').attr('aria-expanded', 'true')
    $('html, body').animate({ scrollTop: $('#' + accordionHeading + ' button').offset().top - 100 }, 'fast')
}

// Trigger for select button/option
function selectButton(name, id) {
    $('#' + name).val(id)
    hideAccordion(name)
}

// Trigger for checkbox checked
function checkedInput(name) {
    value = $('#' + name).val()
    if (value == '') {
        return false
    }
    hideAccordion(name)
}


// Declaring all form input step 1
let birthdate = $('#birthdate')
let marital = $('#marital')
let genetic = $('#genetic')
let height = $('#height')
let waist = $('#waist')
let weight = $('#weight')
let employement = $('#employement')
let work = $('#work')

// Declaring all form input step 2
let diagnosis = $('input[name=diagnosis]')
let living = $('#living')

// Declaring all form input step 3
let gender = $('#gender')

// Declaring all form input step 4
let menstrual = $('#menstrual')
let conception = $('#conception')
let hormone = $('#hormone')
let menopause = $('#menopause')
let history = $('#history')
let wakingup = $('#wakingup')
let tired = $('#tired')
let sleep = $('#sleep')
let gainWeight = $('#gain_weight')

// Declaring all form input step 5
let anxious = $('#anxious')
let memory = $('#memory')
let concentrating = $('#concentrating')
let sexual = $('#sexual')
let lostAttraction = $('#lost_attraction')
let dryness = $('#dryness')
let midSection = $('#mid_section')
let muscle = $('#muscle')

// Declaring all form input step 7
let meds = $('#meds')
let sleepQuality = $('#sleep_quality')
let fulfilled = $('#fulfilled')
let exercise = $('#exercise')
let exerciseDays = $('#exercise_days')
let exerciseForm = $('#exercise_form')
let diet = $('#diet')

// Declaring all form input step 8
let stopCharge = $('#stop_charge')
let achieve = $('#achieve')

// Declaring all form input step 9
let energized = $('#energized')
let time = $('#time')
let hobbies = $('#hobbies')
let depair = $('#depair')
let responsibility = $('#responsibility')
let creative = $('#creative')
let anger = $('#anger')
let mood = $('#mood')
let importantThings = $('#important_things')
let exhausted = $('#exhausted')
let activity = $('#activity')

// Declaring all form input step 10
let vegetables = $('#vegetables')
let fastFood = $('#fast_food')
let snacking = $('#snacking')
let breakfast = $('#breakfast')
let evening = $('#evening')
let juices = $('#juices')
let nuts = $('#nuts')
let nutrition = $('#nutrition')
let healthy = $('#healthy')
let eatSlowly = $('#eat_slowly')

// Declaring all form input step 11
let nails = $('#nails')
let hairProblem = $('#hair_problem')
let plaqueTongue = $('#plaque_tongue')
let stoolColor = $('#stool_color')
let urine = $('#urine')

// Declaring all form input step 12
let pain = $('#pain')
let dietLately = $('#diet_lately')
let intoleranceFood = $('#intolerance_food')
let caffeinatedBeverages = $('#caffeinated_beverages')
let smoke = $('#smoke')
let cannabis = $('#cannabis')

// Declaring all form input step 13
let attentionSpan = $('#attention_span')
let forget = $('#forget')
let nervousPanick = $('#nervous_panick')

// Declaring all form input step 14
let laboratory = $('#laboratory')
let foodAllergies = $('#food_alleries')
let drugsSuplements = $('#drugs_suplements')
let bestDescribe = $('#best_describe')

// Declaring all form input step 15
let distress = $('#distress')
let bowel = $('#bowel')
let giDisease = $('#gi_disease')
let medication = $('#medication')


// Show excercise times and type
$('.exercise-button').click(function() {
    if (exercise.val() == 'Y') {
        $('#exercise_time').show()
        $('#exercise_type').show()
    } else {
        $('#exercise_time').hide()
        $('#exercise_type').hide()
        $('#exercise_days').val('')
        $('#exercise_form').val('')
        $('#exercise_time h2 button span').hide()
        $('#exercise_type h2 button span').hide()
    }
})

// Trigger for previous button
function prevProfiling(step) {
    stepAfter = step + 1;
    if (step == 5) {
        step = 3
    } else if (step == 6 && gender.val() == 2) {
        step = 5
    }
    $('#step' + stepAfter).fadeOut('fast')
    $('#step' + step).fadeIn('slow')
    progress = step * 6.667
    $('.progress-bar').attr('aria-valuenow', progress).css('width', progress + '%');
}

// Trigger for next button
function nextProfiling(step) {
    /*
    let ar = []
    $.each($("input[name='diagnosis']:checked"), function(){
        ar.push($(this).val())
    })
    */
    stepBefore = step - 1
    text = ''
    if (step == 2) {
        if (birthdate.val() == '' || marital.val() == '' || genetic.val() == '' || height.val() == '' || waist.val() == '' || weight.val() == ''|| employement.val() == '' || work.val() == '') {
            if (birthdate.val() == '') {
                text = 'select the Birth date'
                accordion = 'birthdate'
            } else if (marital.val() == '') {
                text = 'select the Marital status'
                accordion = 'marital'
            } else if (genetic.val() == ''){
                text = 'select the Genetic'
                accordion = 'genetic'
            } else if (height.val() == '') {
                text = 'fill the height size'
                accordion = 'height'
            } else if (waist.val() == '') {
                text = 'fill the waist size'
                accordion = 'waist'
            } else if (weight.val() == '') {
                text = 'fill the size of body weight'
                accordion = 'weight'
            } else if (employement.val() == '') {
                text = 'select the employement status'
                accordion = 'employement'
            } else if (work.val() == '') {
                text = 'choose whether you love what you do at work'
                accordion = 'work'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 4) {
        if (gender.val() == '') {
            text = 'select the gender'
            accordion = 'gender'
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        } else if (gender.val() == 1) {
            step = 6
        }
    } else if (step == 5) {
        if (menstrual.val() == '' || hormone.val() == '' || wakingup.val() == ''|| tired.val() == '' || sleep.val() == '' || gainWeight.val() == '') {
            if (menstrual.val() == '') {
                text = 'select the menstrual cycle'
                accordion = 'menstrual'
            //} else if (conception.val() == '') {
            //    text = 'select the conception '
            //    accordion = 'conception'
            } else if (hormone.val() == ''){
                text = 'select the hormone replacement'
                accordion = 'hormone'
            //} else if (menopause.val() == '') {
            //    text = 'select the age at menopause'
            //    accordion = 'menopause'
            //} else if (history.val() == '') {
            //    text = 'select the family history'
            //    accordion = 'history'
            } else if (wakingup.val() == '') {
                text = 'select the waking up difficulty'
                accordion = 'wakingup'
            } else if (tired.val() == '') {
                text = 'choose whether you feel tired or exhausted'
                accordion = 'tired'
            } else if (sleep.val() == '') {
                text = 'choose whether you sleep poorly or not'
                accordion = 'sleep'
            } else if (gainWeight.val() == '') {
                text = 'choose whether you have gained weight recently or have difficulty losing weight'
                accordion = 'gain_weight'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 7 && gender.val() == 2) {
        if (anxious.val() == '' || memory.val() == '' || concentrating.val() == '' || sexual.val() == '' || lostAttraction.val() == '' || dryness.val() == ''|| midSection.val() == '' || muscle.val() == '') {
            if (anxious.val() == '') {
                text = 'choose whether you frequently anxious, nervous or irritable'
                accordion = 'anxious'
            } else if (memory.val() == '') {
                text = 'choose whether you suffer from short or long-term memory loss'
                accordion = 'memory'
            } else if (concentrating.val() == ''){
                text = 'choose whether you have problem concentrating'
                accordion = 'concentrating'
            } else if (sexual.val() == '') {
                text = 'choose whether you lack sexual desire'
                accordion = 'sexual'
            } else if (lostAttraction.val() == '') {
                text = 'choose whether you lost your attraction toward your partner'
                accordion = 'lost_attraction'
            } else if (dryness.val() == '') {
                text = 'choose whether you currently experiencing vaginal dryness'
                accordion = 'dryness'
            } else if (midSection.val() == '') {
                text = 'choose whether you carry your weight in your mid-section'
                accordion = 'mid_section'
            } else if (muscle.val() == '') {
                text = 'choose whether you lost muscle mass, tone and/or strength'
                accordion = 'muscle'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
        stepBefore = step - 2
    } else if (step == 8) {
        if (meds.val() == '' || sleepQuality.val() == '' || fulfilled.val() == '' || exercise.val() == '' || diet.val() == '') {
            if (meds.val() == '') {
                text = 'choose how many prescription meds you taking'
                accordion = 'meds'
            } else if (sleepQuality.val() == '') {
                text = 'choose how many hours/quality of sleep you have'
                accordion = 'sleep_quality'
            } else if (fulfilled.val() == ''){
                text = 'choose how fulfilled are you in life'
                accordion = 'fulfilled'
            } else if (exercise.val() == '') {
                text = 'choose whether you exercise regularly'
                accordion = 'exercise'
            } else if (diet.val() == '') {
                text = 'choose your diet'
                accordion = 'diet'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        } else if (exerciseDays.val() == '' || exerciseForm.val() == '') {
            if (exerciseDays.val() == '') {
                text = 'choose how many days a week do you exercise'
                accordion = 'exercise_days'
            } else if (exerciseForm.val() == '') {
                text = 'choose your prefered form of exercise'
                accordion = 'exercise_form'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 9) {
        if (stopCharge.val() == '' || achieve.val() == '') {
            if (stopCharge.val() == '') {
                text = 'choose whether stop you from taking charge of your health'
                accordion = 'stop_charge'
            } else if (achieve.val() == '') {
                text = 'choose what do you want to achieve through our app'
                accordion = 'achieve'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 10) {
        if (energized.val() == '' || time.val() == '' || hobbies.val() == '' || depair.val() == '' || responsibility.val() == '' || creative.val() == ''|| anger.val() == '' || mood.val() == '' || importantThings.val() == '' || exhausted.val() == '' || activity.val() == '') {
            if (energized.val() == '') {
                accordion = 'energized'
            } else if (time.val() == '') {
                accordion = 'time'
            } else if (hobbies.val() == ''){
                accordion = 'hobbies'
            } else if (depair.val() == '') {
                accordion = 'depair'
            } else if (responsibility.val() == '') {
                accordion = 'responsibility'
            } else if (creative.val() == '') {
                accordion = 'creative'
            } else if (anger.val() == '') {
                accordion = 'anger'
            } else if (mood.val() == '') {
                accordion = 'mood'
            } else if (importantThings.val() == '') {
                accordion = 'important_things'
            } else if (exhausted.val() == '') {
                accordion = 'exhausted'
            } else if (activity.val() == '') {
                accordion = 'activity'
            }
            text = 'fill in all questions'
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 11) {
        if (vegetables.val() == '' || fastFood.val() == '' || snacking.val() == '' || breakfast.val() == '' || evening.val() == '' || juices.val() == ''|| nuts.val() == '' || nutrition.val() == '' || healthy.val() == '' || eatSlowly.val() == '') {
            if (vegetables.val() == '') {
                accordion = 'vegetables'
            } else if (fastFood.val() == '') {
                accordion = 'fast_food'
            } else if (snacking.val() == ''){
                accordion = 'snacking'
            } else if (breakfast.val() == '') {
                accordion = 'breakfast'
            } else if (evening.val() == '') {
                accordion = 'evening'
            } else if (juices.val() == '') {
                accordion = 'juices'
            } else if (nuts.val() == '') {
                accordion = 'nuts'
            } else if (nutrition.val() == '') {
                accordion = 'nutrition'
            } else if (healthy.val() == '') {
                accordion = 'healthy'
            } else if (eatSlowly.val() == '') {
                accordion = 'eat_slowly'
            }
            text = 'fill in all questions'
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 12) {
        if (nails.val() == '' || hairProblem.val() == '' || plaqueTongue.val() == '' || stoolColor.val() == '' || urine.val() == '') {
            if (nails.val() == '') {
                text = 'select your nails look like'
                accordion = 'nails'
            } else if (hairProblem.val() == '') {
                text = 'choose whether you are experiencing any hair problem'
                accordion = 'hair_problem'
            } else if (plaqueTongue.val() == ''){
                text = 'choose whether you have any plaque on your tongue'
                accordion = 'plaque_tongue'
            } else if (stoolColor.val() == '') {
                text = 'select the color of your stool'
                accordion = 'stool_color'
            } else if (urine.val() == '') {
                text = 'select the color of your urine'
                accordion = 'urine'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 13) {
        if (pain.val() == '' || dietLately.val() == '' || intoleranceFood.val() == '' || caffeinatedBeverages.val() == '' || smoke.val() == '' || cannabis.val() == '') {
            if (pain.val() == '') {
                text = 'choose whether you regularly experience pain in any part of your body'
                accordion = 'pain'
            } else if (dietLately.val() == '') {
                text = 'input your diet in past 3 months'
                accordion = 'diet_lately'
            } else if (intoleranceFood.val() == ''){
                text = 'choose whether you have food intolerances'
                accordion = 'intolerance_food'
            } else if (caffeinatedBeverages.val() == '') {
                text = 'input how many caffeinated beverages do you have per day'
                accordion = 'caffeinated_beverages'
            } else if (smoke.val() == '') {
                text = 'choose whether you smoke or not'
                accordion = 'smoke'
            } else if (cannabis.val() == '') {
                text = 'choose whether you take cannabis or not'
                accordion = 'cannabis'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 14) {
        if (attentionSpan.val() == '' || forget.val() == '' || nervousPanick.val() == '') {
            if (attentionSpan.val() == '') {
                text = 'input how much your attention span'
                accordion = 'pain'
            } else if (forget.val() == '') {
                text = 'choose how often you forget things'
                accordion = 'forget'
            } else if (nervousPanick.val() == ''){
                text = 'choose whether you often nervous and/or panicking'
                accordion = 'nervous_panick'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    } else if (step == 15) {
        if (laboratory.val() == '' || foodAllergies.val() == '' || drugsSuplements.val() == '' || bestDescribe.val() == '') {
            if (laboratory.val() == '') {
                text = 'input which laboratory do you usually take tests at'
                accordion = 'laboratory'
            } else if (foodAllergies.val() == '') {
                text = 'input if you have any food allergies'
                accordion = 'food_allergies'
            } else if (drugsSuplements.val() == ''){
                text = 'input which drugs or suplements do you take consistenly'
                accordion = 'drugs_suplements'
            } else if (drugsSuplements.val() == ''){
                text = 'select which of these best describe you'
                accordion = 'best_describe'
            }
            showAccordion(accordion)
            $('#warning').html(text)
            $('#warningModal').modal('show')
            return false
        }
    }

    $('#step' + stepBefore).fadeOut('fast')
    $('#step' + step).fadeIn('slow')
    progress = step * 6.667
    $('.progress-bar').attr('aria-valuenow', progress).css('width', progress + '%');

}

$('#profiling').submit(function() {
    if (distress.val() == '' || bowel.val() == '' || giDisease.val() == '' || medication.val() == '') {
        if (distress.val() == '') {
            text = 'choose whether you have any outward signs of digestive distress'
            accordion = 'distress'
        } else if (bowel.val() == '') {
            text = 'choose which of these best describes your bowel movements'
            accordion = 'bowel'
        } else if (giDisease.val() == ''){
            text = 'choose whether you have GI disease'
            accordion = 'gi_disease'
        } else if (medication.val() == ''){
            text = 'choose whether you regularly take any medication'
            accordion = 'medication'
        }
        showAccordion(accordion)
        $('#warning').html(text)
        $('#warningModal').modal('show')
        return false
    }
})