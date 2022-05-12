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
_Please provide your documentation and outline your choices here._
