<?php
namespace Magnetic\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;
use Zend\Validator\EmailAddress;
use Zend\Validator\Regex;
use Magnetic\Core\EqualInputs;

class User implements InputFilterAwareInterface
{
	public $id;
	public $username;
	public $password;
	public $email;
	public $telephone;
	public $status;
	public $user_ip;
	private $inputFilter;
	
	public function exchangeArray(array $data)
	{
		$this->id     = !empty($data['id']) ? $data['id'] : null;
		$this->username = !empty($data['username']) ? $data['username'] : null;
		$this->status = !empty($data['status']) ? $data['status'] : null;
		$this->email = !empty($data['email']) ? $data['email'] : null;
		$this->telephone = !empty($data['telephone']) ? $data['telephone'] : null;
		$this->password  = !empty($data['password']) ? $data['password'] : null;
		$this->user_ip  = !empty($data['user_ip']) ? $data['user_ip'] : null;
	}
	
	public function getArrayCopy()
	{
		return [
				'id'     => $this->id,
				'username' => $this->username,
				'password'  => $this->password,
				'email' => $this->email,
				'status' => $this->status,
				'telephone' => $this->telephone
		];
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new DomainException(sprintf(
				'%s does not allow injection of an alternate input filter',
				__CLASS__
				));
	}
	
	public function getInputFilter()
	{
		if ($this->inputFilter) {
			return $this->inputFilter;
		}
	
		$inputFilter = new InputFilter();
	
		$inputFilter->add([
				'name' => 'id',
				'required' => true,
				'filters' => [
						['name' => ToInt::class],
				],
		]);
	
		$inputFilter->add([
				'name' => 'username',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'encoding' => 'UTF-8',
										'min' => 3,
										'max' => 6,
								],
						],
				],
		]);
	
		$inputFilter->add([
				'name' => 'password',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'encoding' => 'UTF-8',
										'min' => 6,
										'max' => 12,
								],
						],
				],
		]);
	
		$this->inputFilter = $inputFilter;
		
		return $this->inputFilter;
	}
	public function getRegistrationFilter()
	{
		if ($this->inputFilter) {
			return $this->inputFilter;
		}
	
		$inputFilter = new InputFilter();
	
		$inputFilter->add([
				'name' => 'id',
				'required' => true,
				'filters' => [
						['name' => ToInt::class],
				],
		]);
	
		$inputFilter->add([
				'name' => 'username',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'encoding' => 'UTF-8',
										'min' => 3,
										'max' => 6,
								],
						],
				],
		]);
	
		$inputFilter->add([
				'name' => 'password',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'encoding' => 'UTF-8',
										'min' => 6,
										'max' => 12,
								],
						],
				],
		]);
		$inputFilter->add([
				'name' => 'confirmpassword',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => EqualInputs::class,
						],
				],
		]);
		$inputFilter->add([
				'name' => 'email',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'max' => 20,
								],
						],
						[
								'name' => EmailAddress::class,
						],
				],
		]);
		$inputFilter->add([
				'name' => 'telephone',
				'required' => true,
				'filters' => [
						['name' => StripTags::class],
						['name' => StringTrim::class],
				],
				'validators' => [
						[
								'name' => StringLength::class,
								'options' => [
										'max' => 20,
								],
						],
						[
								'name' => Regex::class,
								'options' => [
										'pattern' => '/[0-9,+,-]/',
								],
						],
				],
		]);
	
		$this->inputFilter = $inputFilter;
	
		return $this->inputFilter;
	}
}