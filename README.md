# 프로젝트 설명
## 기획의도
자동차 키가 누구에게 있는지 몰라서 운전을 못 하는 경우가 있다. 

가족뿐만 아니라 직장에서도 간혹가다 생기는 일이다. 

 차 키가 아닌 스마트폰을 이용하여 시동을 걸게 한다면 이러한 불편함을 해소할 수 있다. 
 
 차량 내부에 있는 블루투스 모듈과 스마트폰을 연결한 뒤, 허용된 사람이라면 시동을 걸게 하면 된다. 
 
 또한 현재 차를 누가 운전하고 있는지, 혹은 차가 어디에 주차되어 있는지를 스마트폰으로 파악할 수 있다면 편리할 것이다. 
 
 시동이 걸려있는 동안 운전자, 위치 정보를 서버에 저장한다면 이를 해결할 수 있다.


## 작품 개요
Carflix 서비스의 목표는 다음과 같다.
```
1) 스마트폰과 블루투스로 통신하며 자동차 키의 기능을 모두 수행할 수 있는 차량 모듈을 설계한다.
2) 서버와 차량 모듈 간 통신을 중재할 수 있는 스마트폰 앱을 설계한다.
3) 특정 그룹에 속한 사람만 스마트폰을 통해 차량을 제어하거나 차량의 위치 정보를 조회할 수 있도록 한다. 
4) 그룹의 차량과 회원을 관리하는 웹페이지를 만들고, 권한이 있는 사용자가 이를 이용할 수 있게 한다.
```


## 서버 구조도
![그림](https://user-images.githubusercontent.com/30142355/214896441-36187818-5214-479f-8ee7-3e64b66ee4ed.png)


## ERD

개체-관계 모델. 테이블간의 관계를 설명해주는 다이어그램이라고 볼 수 있으며, 

이를 통해 프로젝트에서 사용되는 DB의 구조를 한눈에 파악할 수 있다.

즉, API를 효율적으로 뽑아내기 위한 모델 구조도라고 생각하면 된다.

<img width="100%" src="https://user-images.githubusercontent.com/30142355/181522917-6b69d233-ee63-4018-bf6e-4ea3e7c75d6e.png"/>   

<!--
### ERD 상세설명
### code_car테이블 설명

<details><summary style="color:skyblue">CLICK ME</summary>
<p>
    
```
ic_number를 받은 사용자는 해당 ic_number를 등록하면 동시에
invite_code에서 받아온 group_id, status, mb_id를 
car_registeration로 보내서
해당 차량들 같이 보이게 한다.

사용자는 초대코드는 무조건 한번등록
중복 등록 안되고
등록전에 이미 초대코드 발급 받았는지 체크

초대코드로 발급받은 그룹은 사용자가 그룹 삭제시
테이블에서 찾아서 cc_id 삭제하면 그룹해제됨
```   
</p>
</details>    
    
### vehicle_status 테이블 설명

<details><summary style="color:skyblue">CLICK ME</summary>
<p>
    
```
아두이노로부터 cr_id, member, vs_authentication_value를 받고
임의의 난수로 시동정보ID 생성해서 DB에 넣고 다시 아두이노로 전송

그후로 실시간으로 시동상태를 전송받는다.

이때 시동정보 ID와 위도, 경도를 받아서 DB에 계속 넣어주자.
처음에 시동 요청이 왔을 때 즉, 시동정보ID를 생성하기 전에는 위도, 경도에 0값을 넣어주자.
```   
</p>
</details>  

-->


## 테이블 구조

`schema.md` 참조


## API 문서화

`api.md` 참조


## PHP와 OOP를 활용한 RESTful API 개발 단계별 안내
PHP를 사용하여 객체 지향 프로그래밍(OOP) 스타일로 RESTful API를 만드는 방법을 설명해드리겠습니다. 

RESTful API는 HTTP를 통해 데이터를 주고받는 웹 서비스를 설계하는 방법 중 하나입니다.

#### 1. 클래스 및 파일 구조 설계:

- 먼저, API 엔드포인트 및 리소스에 대한 클래스를 설계합니다. 
예를 들어, 사용자 데이터를 관리하는 API를 만들고자 한다면, "User" 클래스를 만들 수 있습니다. 
각 리소스마다 별도의 클래스를 생성하는 것이 좋습니다.

- 클래스는 관련 기능을 캡슐화하고 메서드를 통해 API 작업을 수행합니다. 
예를 들어, 사용자를 생성, 읽기, 업데이트 및 삭제하는 메서드를 클래스에 추가할 수 있습니다.

#### 2. 클래스 파일 작성:

- 클래스 파일은 PHP 파일로 작성되어야 합니다. 
예를 들어, "User.php"라는 파일에 "User" 클래스를 정의합니다.

- 클래스는 필요한 속성과 메서드를 포함해야 합니다. 
예를 들어, 사용자 정보를 저장하는 속성 및 사용자를 생성, 읽기, 업데이트, 삭제하는 메서드를 클래스에 추가합니다.

```php
class User {
    private $db; // 데이터베이스 연결을 위한 속성

    public function __construct() {
        // 데이터베이스 연결 초기화
    }

    public function createUser($userData) {
        // 사용자 생성 로직
    }

    public function readUser($userId) {
        // 사용자 읽기 로직
    }

    public function updateUser($userId, $userData) {
        // 사용자 업데이트 로직
    }

    public function deleteUser($userId) {
        // 사용자 삭제 로직
    }
}
```

#### 3. 라우팅 및 요청 처리:

- API 요청을 처리하기 위해 라우팅 메커니즘을 구현해야 합니다. 
PHP에서는 주로 Apache의 mod_rewrite를 사용하거나, 라우팅 라이브러리를 활용합니다.

- API 엔드포인트와 요청 메서드(GET, POST, PUT, DELETE)를 매핑합니다.

- 요청이 들어오면 해당 요청을 적절한 클래스 및 메서드로 라우팅하여 처리합니다.

#### 4. 데이터베이스 연동:

- 데이터베이스와 연동하여 데이터를 저장, 검색, 업데이트, 삭제합니다.
PHP에서는 MySQL, PostgreSQL, SQLite 등과 같은 데이터베이스를 사용할 수 있습니다.

- PDO 또는 MySQLi와 같은 데이터베이스 라이브러리를 사용하여 연결하고 쿼리를 실행합니다.

#### 5. 응답 생성:

- API 요청을 처리한 후, JSON 또는 XML과 같은 형식으로 응답을 생성합니다. 
PHP에서는 json_encode 함수를 사용하여 배열을 JSON으로 변환하고,
HTTP 헤더를 설정하여 클라이언트에게 올바른 응답을 보냅니다.

#### 6. 보안 고려사항:

- API 보안을 고려하여 인증 및 권한 부여 메커니즘을 구현합니다.

- SQL 인젝션 및 다른 보안 취약점으로부터 API를 보호하기 위한 조치를 취합니다.



이러한 단계를 따르면 PHP를 사용하여 객체 지향적으로 RESTful API를 만들 수 있습니다. 

각 클래스는 특정 리소스를 관리하고, 요청을 처리하고, 데이터를 데이터베이스에 저장하거나 검색하는 데 사용됩니다. 

이렇게 설계된 API는 유지 보수가 용이하며 확장성이 뛰어납니다.


##
| 개발자 | 메일                    |
| ------ | ----------------------- |
| 최정길 | dev.ebosda000@gmail.com  |


