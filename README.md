# Backend Coding Challenge
The main objective of this challenge is to get an idea of your backend development skills.

## Expectations
At Prescreen, we value well-structure and tested code. How you approach the problem and what exactly you deliver - that's entirely up to you. We would love that you deliver a solution that you're proud of within the given timeframe.

### README
Use this README to document what you've built.
Make sure the reviewer of this challenge understands your choices, limitations, and technical reasoning. You can include:
- a description of what you've built. Any sort of visuals are always lovely to have.
- the reason behind your technological choices. Trade-offs you had to make due to time limitations.
- additional features you would have added if you'd spend more time on the project.

### Commit Messages
We consider commit messages as part of our documentation; that's why we encourage you to use separate and descriptive commit messages to distinguish between different steps of your development.

### The Challenge
A squad of robotic rovers are to be landed by NASA on a plateau on Mars. This plateau, which is curiously rectangular, must be navigated by the rovers so that their on-board cameras can get a complete view of the surrounding terrain to send back to Earth. A rover's position and location is represented by a combination of x and y co- ordinates and a letter representing one of the four cardinal compass points. The plateau is divided up into a grid to simplify navigation.An example position might be 0, 0, N, which means the rover is in the bottom left corner and facing North.In order to control a rover, NASA sends a simple string of letters.The possible letters are 'L', 'R' and 'M'.

'L' and 'R' makes the rover spin 90 degrees left or right respectively, without moving from its current spot.
'M' means move forward one grid point, and maintain the same Heading.Assume that the square directly North from (x, y) is (x, y+1).

#### Input
The first line of input is the upper-right coordinates of the plateau, the lower- left coordinates are assumed to be 0,0.
The rest of the input is information pertaining to the rovers that have been deployed. Each rover has two lines of input. The first line gives the rover's position, and the second line is a series of instructions telling the rover how to explore the plateau. The position is made up of two integers and a letter separated by spaces, corresponding to the x and y co-ordinates and the rover's orientation. Each rover will be finished sequentially, which means that the second rover won't start to move until the first one has finished moving.

#### Output
The output for each rover should be its final co-ordinates and heading.

#### Input & Output 
##### Test Input
```
5 5
1 2 N 
L M L M L M L M M
3 3 E
M M R M M R M R R M
```

##### Expected Output
```
1 3 N
5 1 E
```

---

### Final Note

Feel free to contact us by creating an issue on Github during the implementation of the code challenge if you have any questions or concerns.

Happy hacking & good luck! 🚀

---

## Candidate's documentation

### Application

#### Description

I have built a kind of simulator for rovers on Mars. The idea, following the challenge, is that you can simulate the plateau and the rovers' situation and movements. The simulator interprets yous instructions and checks they don't have any sort of problems. It checks:

* The instructions are complete and well formated.
* The rovers don't go outside the plateau.
* The rovers don't move forward to a position already occupied by another rover.

The application has a basic frontend so the user can enter the instructions and get the simulation result.

#### How to run

I used Sail, a built-in solution of Laravel, to run the application on docker. All you have to do is to run the next commands:

```bash
cp .env.example .env
composer install
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm install
./vendor/bin/sail npm run production
```

Now you can visit http://localhost and see the application running.

When you finish you can stop the docker containers by running:

```bash
./vendor/bin/sail stop
```

If you don't use docker and have composer and npm installed on you computer you can just run the commands without sail:

```bash
cp .env.example .env
composer install
php artisan key:generate
npm install
npm run production
```

#### How to run the tests

If you want to run the PHP tests just run:

```bash
./vendor/bin/sail artisan test
```

If you don't use docker run:

```bash
php artisan test
```

### Technical points

I don't have too much free time (15 months old son) so I built the application with Laravel, the PHP framework I'm fluent in. I know at Prescreen Symfony is the framework used but I didn't want to get stuck and loose time. I could spent only between 15 and 18 hours to create the application.

For the frontend, I wanted to build it with Vue. I'm fullstack but the last years I've been more focused on the frontend. But due to lack of time I preferred to keep it simple and just use HTML with CSS.

Regarding how the application works I made some decisions. When reading the instructions I check they are well formatted, that means they have to follow some rules:

* The plateau coordinates must be greater than zero.
* The rover position must have a valid positions inside the plateau and a valid heading.
* The rover movements must be valid movements and don't move outside the plateau or in other rover's current position.
* Every line of the instructions cannot have spaces nor the beginning or the end.
* There must be at least three lines in the instructions (plateau coordinates and one rover instructions).

This cause that the instructions must have a specific format. For example, the test input given above this README would fail in the simulator because the second line has a space at the end.

### Additional features

At the beginning my idea was to have more features like a new simulator mode with a form to build the instructions instead of writting them in plain text, or a command console to run the simulation on the terminal. But again due to the lack of time I didn't add them.

Also I would have liked to add e2e tests.
