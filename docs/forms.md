# Forms (In progress)

# Overview
The Rapid Forms feature of this Model View Controller (MVC) Framework allows the user to quickly create and style forms. This guide thoroughly describes the ability to create these HTML form elements along with a description and examples. If you would like support for additional features please create an issue [here](https://github.com/chapmancbVCU/chappy-php/issues).

# button
This function creates a button with no surrounding HTML div element. It supports the ability to set attributes such as classes and event handlers. If you want a div to surround a button along with any other attributes we recommend that you use the buttonBlock function. Note the example function call shown below in Figure 1.

<div style="text-align: center;">
  <img src="assets/button-function-call.png" alt="Example button function call">
  <p style="font-style: italic;">Figure 1 - Example button function call</p>
</div>

This function accepts 2 arguments as described below:
1. $buttonText is used to set the text of the button.
2. $inputAttrs is an array and can be found in most function calls. We use this parameter to set values for attributes such as classes for styling, front-side validation, and event handlers. Make sure when performing an event handler function call that contains strings as arguments to escape any quotes. The default value is an empty array.