<?php

namespace CityHunter\LaravelMetaData\Tests\Features;

use CityHunter\LaravelMetaData\Tests\TestCase;

class UserMetaHelperTests extends TestCase
{
    /**
     * Test get_user_meta() function.
     *
     * @return void
     */
    public function testGetUserMeta()
    {
        $user_id = 1;
        $key = 'my_key';
        $value = 'my_value';
        add_user_meta($user_id, $key, $value);

        // Test with key specified
        $meta = get_user_meta($user_id, $key);
        $this->assertEquals($value, $meta);

        // Test without key specified
        $meta = get_user_meta($user_id);
        $this->assertIsArray($meta);

        // Test with unique set to true
        $meta = get_user_meta($user_id, null, true);
        $this->assertIsString($meta);
    }

    /**
     * Test add_user_meta() function.
     *
     * @return void
     */
    public function testAddUserMeta()
    {
        $user_id = 1;
        $key = 'my_key';
        $value = 'my_value';

        // Test adding meta
        $result = add_user_meta($user_id, $key, $value);
        $this->assertTrue($result);

        // Test adding duplicate meta
        $result = add_user_meta($user_id, $key, $value);
        $this->assertFalse($result);
    }


//    public function testGetUserMetaWithMock()
//    {
//        $userId = 1;
//        $key = 'foo';
//        $value = 'bar';
//
//        // Create a mock of the UserMeta class
//        $userMetaMock = $this->getMockBuilder(\CityHunter\LaravelMetaData\User\UserMeta::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        // Define the expected result of the getUserMeta method
//        $expectedResult = new \Illuminate\Database\Eloquent\Collection([
//            new \CityHunter\LaravelMetaData\User\UserMeta([
//                'user_id' => $userId,
//                'meta_key' => $key,
//                'meta_value' => $value,
//            ]),
//        ]);
//
//        // Set up the mock to return the expected result when called with the specified arguments
//        $userMetaMock->expects($this->once())
//            ->method('getUserMeta')
//            ->with($userId, $key, false)
//            ->willReturn($expectedResult);
//
//        // Call the function being tested and assert that it returns the expected result
//        $result = get_user_meta($userId, $key);
//        $this->assertEquals($expectedResult, $result);
//    }
//
//    public function testAddUserMetaWithMock()
//    {
//        $userId = 1;
//        $key = 'foo';
//        $value = 'bar';
//
//        // Create a mock of the UserMeta class
//        $userMetaMock = $this->getMockBuilder(\CityHunter\LaravelMetaData\User\UserMeta::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        // Define the expected result of the addUserMeta method
//        $expectedResult = true;
//
//        // Set up the mock to return the expected result when called with the specified arguments
//        $userMetaMock->expects($this->once())
//            ->method('addUserMeta')
//            ->with($userId, $key, $value)
//            ->willReturn($expectedResult);
//
//        // Call the function being tested and assert that it returns the expected result
//        $result = add_user_meta($userId, $key, $value);
//        $this->assertEquals($expectedResult, $result);
//    }
//
//    public function testUpdateUserMeta()
//    {
//        $userId = 1;
//        $key = 'foo';
//        $value = 'bar';
//
//        // Create a mock of the UserMeta class
//        $userMetaMock = $this->getMockBuilder(\CityHunter\LaravelMetaData\User\UserMeta::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        // Define the expected result of the updateUserMeta method
//        $expectedResult = true;
//
//        // Set up the mock to return the expected result when called with the specified arguments
//        $userMetaMock->expects($this->once())
//            ->method('updateUserMeta')
//            ->with($userId, $key, $value)
//            ->willReturn($expectedResult);
//
//        // Call the function being tested and assert that it returns the expected result
//        $result = update_user_meta($userId, $key, $value);
//        dd($result);
//        $this->assertEquals($expectedResult, $result);
//    }
}
