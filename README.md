# Laravel State machine Presentation

## With Traditional MVC

### Problems

 - Difficult to determine what rules apply and when.
 - Duplication of logic at every place we want to update the state.
 - Difficult to add new states.
 - Difficult to add new transitions.
 - Code Only ever grows in complexity. // https://www.youtube.com/watch?v=0SARbwvhupQ

## What's is a state machine?

A state machine is a mathematical model of computation. 
It is an abstract machine that can be in exactly one of a finite number of states at any given time.
The FSM(finite state machine) can change from one state to another in response to some external inputs and/or a condition is satisfied;
the change from one state to another is called a transition.
An FSM is defined by a list of its states, its initial state, and the inputs that trigger each transition.

## Why use a state machine?

A state machine is a good way to model the behavior of a system.
It can be used to represent a system's behavior in a simple, understandable and predictable way.
It can also be used to design a system's architecture.

## How to use a state machine? in Laravel?

There are many ways to implement a state machine in Laravel.
The most common way is to use a state machine library.
There are many state machine libraries available for Laravel.

For the purpose of presentation we are going to use the following library: https://github.com/sebdesign/laravel-state-machine

## Our example

### state diagram
https://excalidraw.com/#json=mbw-zaQh3YyS8RmUxG1w-,-BecmPZ5x5UFIALDxJT0xg

## Resources

- https://en.wikipedia.org/wiki/Finite-state_machine
- Book - Domain-Driven Design: Tackling Complexity in the Heart of Software
- Book - Design Patterns: Elements of Reusable Object-Oriented Software
