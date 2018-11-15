## P3 Peer Review

+ Reviewer's name: Chris Crane
+ Reviwee's name: Margaret C
+ URL to Reviewe's P3 Github Repo URL: *<https://github.com/mjcrocamo/p3>*

## 1. Interface
My first impression of the interface is that it comes across as playful, you want to enter you name and birth month to discover your pirate name! 

There was one part of the interface that I was unsure about. I had to resubmit the form several time to determine it's effect.  Based on the label name for the control, `Reverse Name` suggests that the `First Name` and `Last Name` field values would be swapped when checked. However when `Reverse Name` is checked, the pirate name produced is reversed.

I liked how the background carried the *pirate*, *old world* theme, and tied the interface together. The positioning of the `Birth Month` field between the `First Name` and `Last Name` fields gives the impression you are playing a game.

Improvements I can suggest are to replace the center everything design with a more distinct looking form element, and also add client-side validation. 

## 2. Functional testing
Tests:

+ Submitting the form without entering any data
    * _Form submitted and server side validation performed as expected_.
+ Submitting the form with only `First Name` entered.
    * _Form submitted and server side validation performed as expected_.
+ Submitting the form with only `Last Name` entered.
    * _Form submitted and server side validation performed as expected_.
+ Submitting the form with only `Birth Month` entered.
    * _Form submitted and server side validation performed as expected_.
+ Submitting the form with all combinations where two of `First Name`, `Last Name`, and` Birth Month` are entered.
    * _Form submitted and server side validation performed as expected_.
+ Submitting the form with digits entered in one of, and both of, the `First Name` and `Last Name` fields
    * _Form submitted and server side validation performed as expected_.
+ Submitting the form with non-alphanumeric characters entered in one of, and both of, the `First Name` and `Last Name` fields
    * _Form submitted and server side validation performed as expected_.
+ Tried accessing  *<http://p3.maggiecroc11.me/xyz>* and received a `404` error.

The only issue I found is that the `Birth Month` field does not retain it's value when a validation error occurs.

## 3. Code: Routes
There is **NO** code in the routes file that should be migrated to a controller.

## 4. Code: Views
* Template inheritance is used via a master layout template `/resourses/views/layouts/master.blade.php`
* There is **NO** non-display logic in the view files. All non-display logic is contained in the `/app/Http/Controllers/PirateController.php` controller.
* Blade is used exclusively in all view resources.
* No unfamiliar Blade syntax or techniques identified. 

## 5. Code: General
* The only code style inconsistency identified is the extra line spacing.
* All best practices have been followed.
* The main program logic had no commentary.
* All coding choices are reasonable, the code itself is quite readable and easily understand.
* Nothing of interest or unknown identified.

## 6. Misc
*Overall the web app was fun to use, and works very well. Great job!*
