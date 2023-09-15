# 프로젝트 설명
## 1. 기획의도
자동차 키가 누구에게 있는지 몰라서 운전을 못 하는 경우가 있다. 

가족뿐만 아니라 직장에서도 간혹가다 생기는 일이다. 

 차 키가 아닌 스마트폰을 이용하여 시동을 걸게 한다면 이러한 불편함을 해소할 수 있다. 
 
 차량 내부에 있는 블루투스 모듈과 스마트폰을 연결한 뒤, 허용된 사람이라면 시동을 걸게 하면 된다. 
 
 또한 현재 차를 누가 운전하고 있는지, 혹은 차가 어디에 주차되어 있는지를 스마트폰으로 파악할 수 있다면 편리할 것이다. 
 
 시동이 걸려있는 동안 운전자, 위치 정보를 서버에 저장한다면 이를 해결할 수 있다.


## 2. 작품 개요
Carflix 서비스의 목표는 다음과 같다.
```
1) 스마트폰과 블루투스로 통신하며 자동차 키의 기능을 모두 수행할 수 있는 차량 모듈을 설계한다.
2) 서버와 차량 모듈 간 통신을 중재할 수 있는 스마트폰 앱을 설계한다.
3) 특정 그룹에 속한 사람만 스마트폰을 통해 차량을 제어하거나 차량의 위치 정보를 조회할 수 있도록 한다. 
4) 그룹의 차량과 회원을 관리하는 웹페이지를 만들고, 권한이 있는 사용자가 이를 이용할 수 있게 한다.
```

## 3. 서버 구조도
![그림](https://user-images.githubusercontent.com/30142355/214896441-36187818-5214-479f-8ee7-3e64b66ee4ed.png)



## 4. ERD

개체-관계 모델. 테이블간의 관계를 설명해주는 다이어그램이라고 볼 수 있으며, 

이를 통해 프로젝트에서 사용되는 DB의 구조를 한눈에 파악할 수 있다.

즉, API를 효율적으로 뽑아내기 위한 모델 구조도라고 생각하면 된다.

<img width="100%" src="https://user-images.githubusercontent.com/30142355/181522917-6b69d233-ee63-4018-bf6e-4ea3e7c75d6e.png"/>   

### 4.1. ERD 상세설명
### 4.1.1. code_car테이블 설명

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
    
### 4.1.2. vehicle_status 테이블 설명

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



## 5. 테이블 구조

관계형 데이터베이스에서 데이터들을 목록별로 정리해서 완성된 하나의 집합체를 테이블이라고 합니다.

`schema.md` 참조



## 6. API 문서화

API는 응용 프로그램에서 사용할 수 있도록, 운영 체제나 프로그래밍 언어가 제공하는 기능을 제어할 수 있게 만든 인터페이스를 뜻한다.

`api.md` 참조



##

| 개발자 | 메일                    |
| ------ | ----------------------- |
| 최정길 | dev.ebosda000@gmail.com  |


