@extends('layouts.quizhead')
@section('username',$user->fullname)
<!--Fantacy Design-->
@section('content')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('quiz.css')}}" />
    <title>Quiz App | Fantacy Design</title>
  </head>
  <body>
    <div class="quiz-container" id="quiz">
      <div class="quiz-header">
        <h2 id="question">Question text</h2>
        <ul>
          <li>
            <input type="radio" name="answer" id="a" class="answer">
            <label for="a" id="a_text">Question</label>
          </li>

          <li>
            <input type="radio" name="answer" id="b" class="answer">
            <label for="b" id="b_text">Question</label>
          </li>

          <li>
            <input type="radio" name="answer" id="c" class="answer">
            <label for="c" id="c_text">Question</label>
          </li>

          <li>
            <input type="radio" name="answer" id="d" class="answer">
            <label for="d" id="d_text">Question</label>
          </li>
        </ul>
      </div>
      <button id="submit">Submit</button>
    </div>
    <!-- <script src="{{asset('quiz.js')}}"></script> -->
    <script>
        const quizData = [];
        var i=0;
        @foreach($quiz as $q)
            quizData[i] = {
                question : "{{$q->question}}",
                a : "{{$q->a}}",
                b : "{{$q->b}}",
                c : "{{$q->c}}",
                d : "{{$q->d}}",
                correct : "{{$q->answer}}"
            }
            i=i+1;
        @endforeach
        console.log(quizData);
       
        const quiz = document.getElementById('quiz')
        const answerEls = document.querySelectorAll('.answer')
        const questionEl = document.getElementById('question')
        const a_text = document.getElementById('a_text')
        const b_text = document.getElementById('b_text')
        const c_text = document.getElementById('c_text')
        const d_text = document.getElementById('d_text')
        const submitBtn = document.getElementById('submit')

        let currentQuiz = 0
        let score = 0

        loadQuiz()

        function loadQuiz() {
            deselectAnswers()

            const currentQuizData = quizData[currentQuiz]

            questionEl.innerText = currentQuizData.question
            a_text.innerText = currentQuizData.a
            b_text.innerText = currentQuizData.b
            c_text.innerText = currentQuizData.c
            d_text.innerText = currentQuizData.d
        }

        function deselectAnswers() {
            answerEls.forEach(answerEl => answerEl.checked = false)
        }

        function getSelected() {
            let answer

            answerEls.forEach(answerEl => {
                if(answerEl.checked) {
                    answer = answerEl.id
                }
            })

            return answer
        }

        submitBtn.addEventListener('click', () => {
            const answer = getSelected()

            if(answer) {
                if(answer === quizData[currentQuiz].correct) {
                    score++
                }

                currentQuiz++

                if(currentQuiz < quizData.length) {
                    loadQuiz()
                } else {
                    if(score != quizData.length){
                        quiz.innerHTML = `
                        <h2>You answered ${score}/${quizData.length} questions correctly 
                        <br>Score 5/5 to update the status and win rewards</h2>

                        <button onclick="location.href='/memsearch'">Continue</button>
                    `
                    }
                    else{
                        quiz.innerHTML = `
                        <h2>You answered ${score}/${quizData.length} questions correctly
                        <br>Congratulations!! You earned rewards for this achievement</h2>
                        <button onclick="location.href='{{route('quizfin',['accId'=>$accId])}}'">Continue</button>
                    `
                    }
                    
                }
            }
        })   
    </script>
  </body>
</html> 
@endsection