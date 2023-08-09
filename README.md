## Team Members
Issa Farhat

## Brief Explanation about the website
Quizverse is a web application developed using PHP and Laravel, offering a wide
range of advanced features to create, share, and solve quizzes. With a sleek and intuitive
interface, Quizverse provides a seamless user experience for creating, modifying, managing,
and solving quizzes. The application boasts features such as guest access, allowing users to
explore the platform without registering, and quiz creation that enables registered users to
design quizzes with customizable parameters such as title, description, and question types,
as well as privacy settings for these quizzes.

## Usage
When you first visit the site, you start off as a guest. As a guest, you can browse and search quizzes, as well as view them and attempt to solve
them, however actually submitting your response will require you to register (or login if you already have an account). You'll also have to be logged in if you want to create quizzes.

Once logged in, you can submit responses to quizzes (only one response per quiz to prevent spamming), and you can start creating your own quizzes !
Upon quiz creation you can configure the title, description, tags (at least 1), as well as set the quiz to private or not private (private quizzes
won't appear on the public page and can't be found through search).

After creating a quiz, you're taken to the edit page, where you can add (and delete) questions to your quiz, as well as configure the quiz again (change title, description, private setting, etc...) or delete the quiz all together.

When adding a question you're taken to a create question page. There are three types of questions : Text,MCQ,MSQ and the page gives you some instructions about how to go about creating the questions.

Everytime you add a question you're taken back to the edit page where you can view how you quiz is shaping up, and you can press preview to go the submit page which is the page of what other users will see when they enter your quiz.

When you submit a quiz, you'll be taken to a page that shows you your response as well as the wrong and correct answers you've gotten, and your final score.

If you're the owner of a quiz, it'll show up in the list of quizzes when you own when you press "manage quizzes". Here you can edit, delete, or view the responses your quizzes have gotten.

## Important note concerning the functionaility video :
I forgot to showcase what happens if you try to submit the same quiz twice. What will happen is simply that you will be redirected back to your current page when you hit submit, with a flash message telling you that you have already submitted this quiz.

## How to run
1. Download the source code and extract the zip file
2. Download or set up any local web server that runs PHP script, such as XAMPP, WAMP, or MAMP.
3. Copy the extracted source code of the Laravel-PHP task management system to the appropriate location where your local web server can access it. For example, if you are using XAMPP, you can paste the source code in the 'htdocs' folder, which is usually located at 'C:\xampp\htdocs'.Open a web browser and browse the project. 
4. Install the required dependencies using a package manager like Composer. Open a command prompt or terminal in the extracted project directory and run the command: composer install 
5. Create a copy of the .env.example file and rename it to .env. Update the .env file with your local database settings, including the database name, username, and password.
6. Generate a new Laravel application key by running the command: php artisan key:generate
7. Create a new database in your local database server with the same name specified in the .env file ("laravel").
8. Migrate the database tables by running the command: php artisan migrate
9. Start the Laravel development server by running the command: php artisan serve
10. Open a web browser and access the Laravel project by browsing the  URL provided by the Laravel development server.
11. Browse the website as a guest or register as a new user. If you want, you can login to an already existing user (Username : Issa@email.com, Password : Hello9)

## Features
1. Guests can browse, search, and view quizzes without signing up (anonymously).
2. Members can create quizzes using a variety of questions and question types (Yes/No, multiple choice, text based, etc…). 
3. Quizzes have a privacy setting which allows them to be displayed on the public page or not.
4. Quizzes are graded automatically (The correct answers are set during the creation of the quiz).
5. Quizzes can be shared seemlessly though copying the link you get during previewing the quiz (when you're on the show page)
    1. This coupled with the privacy setting allows you to share your quizzes with only the people you want to share them with.


## Credits
Special thanks to Traversy Media's Laragigs Tutorial : (https://youtu.be/MYyJ4PuL4pY)






