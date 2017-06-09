# Enum
```
/**
 * Base Enum class
 *
 * Create an enum by implementing this class and adding class constants.
 *
 * ```php
 * class Action extends Enum
 * {
 *     const VIEW = 'view';
 *     const EDIT = 'edit';
 * }
 *
 * $action = Action::VIEW();
 * $action = new Action(Action::VIEW);
 * ```
 */
```
- __construct($value)
```
/**
     * Creates a new value of some type
     *
     * @param mixed $value
     *
     * @throws UnexpectedValueException if incompatible type is given.
     */
```
- getValue()
```
/**
     * @return mixed
     */
```
- getKey()
```
/**
     * Returns the enum key (i.e. the constant name).
     *
     * @return mixed
     */
```
- __toString()
```
/**
     * @return string
     */
```
- equals(Enum $enum)
```
/**
     * Compares one Enum with another.
     *
     * This method is final
     *
     * @return bool True if Enums are equal, false if not equal
     */
```
- keys()
```
/**
     * Returns the names (keys) of all constants in the Enum class
     *
     * @return array
     */
```
- values()
```
/**
     * Returns instances of the Enum class of all Enum constants
     *
     * @return static[] Constant name in key, Enum instance in value
     */
```
- toArray()
```
/**
     * Returns all possible values as an array
     *
     * @return array Constant name in key, constant value in value
     */
```
- isValid($value)
```
/**
     * Check if is valid enum value
     *
     * @param $value
     *
     * @return bool
     */
```
- isValidKey($key)
```
/**
     * Check if is valid enum key
     *
     * @param $key
     *
     * @return bool
     */
```
- search($value)
```
/**
     * Return key for value
     *
     * @param $value
     *
     * @return mixed
     */
```
- __callStatic($name, $arguments)
```
/**
     * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     * @throws BadMethodCallException
     */
```

