# khk-market
### 메이플 스토리 경매장을 모티브한 게임 아이템 경매장
개발기간 : 2021.04-2021.05 
## 개발 목적
- 세부검색 기능을 제작해 db 쿼리를 연습
- 데이터베이스 트랜잭션에 대한 이해와 공부

## 개발 환경
- nginx 1.19.7
- php 8.02
- mariadb 10.3.31

## 구현 기능
- 로그인, 로그아웃, 회원가입
- 아이템명 빠른 검색
- 아이템 세부 조건 검색
- 아이템 판매 등록
- 아이템 구매&판매 트랜잭션, 트리거

## 기술 설명
- 사용자 입력에 **php PDO**를 적용해 **SQL 인젝션**을 염두하고 개발했습니다.
- 구매 혹은 판매시 **트랜젝션**중 테이블간 **트리거**를 사용했습니다.
- 세부 검색조건에 클라이언트가 올바르지 않은 입력값을 입력했을때 등 **예외처리**를 적용했습니다.
- 예를들어 숫자입력에 한글입력 혹은 "0 ~ 1500" 검색이 올바르지만 "1500 ~ 0" 검색 등 세부검색 조건을 여러가지 형태로 쿼리문을 작성해봤습니다.

## 사용 기술 정리
- bootstrap5 반응형 웹
- PHP PDO
- DB transaction, triger

## 후기
- 건강상의 문제로 약 1년여만에 개발공부를 다시 시작하게 된 후 제작한 웹페이지입니다.
- 개발목적은 쿼리문을 다루는 연습에 있었지만 **아이템 인벤토리 테이블**을 구현하면서 고민이 많았습니다.
- 아이템 이미지를 어떻게 해야될까 고민도 했었는데 제가 직접 그렸습니다.
- 새로운 개발환경이 나왔을 때 공식 홈페이지에 들어가 직접 doc를 읽고 개발습관을 들이려고 당시 새롭게 릴리즈 된 부트스트랩5를 적용해 모바일에서도 반응할 수 있도록 제작했습니다. 
- 머리속에서 생각한대로 테이블을 짜고 아이템 인벤토리를 DB로 구현하는것이 어려웠습니다. 그래서 ERD가 엉성한것이 가장 아쉽다고 느껴집니다. 좀 더 DB에 관해 전문적으로 공부 해야겠다는 생각이 들었습니다.
- 여러 쿼리문을 작성하고 적용하다보니 띄엄띄엄 알고있던 쿼리문에 익숙해졌고, 확실히 쿼리문에 대한 숙련도가 향상된 것을 느낄 수 있었습니다.

***
## ERD
![경매장ERD](https://user-images.githubusercontent.com/58419328/146550007-a6ea972d-2a4b-4ff5-871a-8f98bb6f2ea9.png)   

### 구매, 판매 트랜잭션, 및 트리거 사용 기술 정리
- inventories 테이블에 아이템 정보를 가진 아이디와, 소유자 아이디, 옥션에 등록되었는지 확인 할 수있는 옥션아이디를 가지고 있는 것이 특징입니다.
- 옥션에 거래를 등록한 경우 inventoires에 있는 id정보가 auction 테이블에 등록되고 트리거로 inventoires 테이블은 옥션id를 저장해 해당 아이템이 어떤 정보를 가지고 있는지(판매중)임을 알 수 있도록 했습니다.
- 구매요청이 들어오면 auction테이블과 iventoreis테이블의 정보조회를 통해 판매자과 구매자가 같을시 발생하는 예외사항을 처리했습니다.
- 정상적으로 구매가 완료되면 트리거를 이용해 auction 판매 정보를 auction_sold 로 정보를 옮겨 로그화 해봤습니다.
- 그리고 이어 트리거로 inventoires 테이블에 구매한 유저에 대한 정보를 수정해 해당 유저의 아이템 목록이 변경됩니다.

***
## PDF

![슬라이드1](https://user-images.githubusercontent.com/58419328/146551983-8c16282e-4b5f-4aa0-875b-75e81585cac8.PNG)
![슬라이드2](https://user-images.githubusercontent.com/58419328/146551992-c19577f7-2e86-41b5-bef5-400e3932d1a4.PNG)
![슬라이드3](https://user-images.githubusercontent.com/58419328/146551996-fe188ae2-90e1-4de0-8949-b782439b9470.PNG)
![슬라이드4](https://user-images.githubusercontent.com/58419328/146552002-285ecb37-3609-4e0f-a3b0-442a9da33a8e.PNG)
![슬라이드5](https://user-images.githubusercontent.com/58419328/146552004-bf84f4c7-d0ff-432f-ab05-044cb0fae2f9.PNG)
![슬라이드6](https://user-images.githubusercontent.com/58419328/146552009-af831651-49e6-43a5-9254-f9b9d47cf0b4.PNG)
![슬라이드7](https://user-images.githubusercontent.com/58419328/146552013-b5270135-1b2e-4335-92c9-61186c80278c.PNG)
![슬라이드8](https://user-images.githubusercontent.com/58419328/146552016-634a3a87-49cf-4584-8b1f-140055b57068.PNG)
![슬라이드9](https://user-images.githubusercontent.com/58419328/146552020-65a3643e-34ec-4b1b-be13-6d1cc4bdf43e.PNG)
![슬라이드10](https://user-images.githubusercontent.com/58419328/146552028-c26c6a8d-9d0b-439a-b79e-ce79f32decdc.PNG)
![슬라이드11](https://user-images.githubusercontent.com/58419328/146552036-a2445594-7787-4d39-98e9-29dcfe168fbb.PNG)
![슬라이드12](https://user-images.githubusercontent.com/58419328/146552041-55f00bff-970f-40e0-aa3c-db3c8b46bd47.PNG)
![슬라이드13](https://user-images.githubusercontent.com/58419328/146552046-8ba034dc-ec98-4148-8ed4-ef0a896163a3.PNG)
![슬라이드14](https://user-images.githubusercontent.com/58419328/146552055-6dcb1c90-b1d6-4198-a019-9670d5cf050f.PNG)
![슬라이드15](https://user-images.githubusercontent.com/58419328/146552059-b7d8b9d6-f070-4ea8-9007-8f92608080df.PNG)
![슬라이드16](https://user-images.githubusercontent.com/58419328/146552063-3c0feb66-59d3-4f44-9ea1-cccf24f73943.PNG)
![슬라이드17](https://user-images.githubusercontent.com/58419328/146552064-84a6ba4c-3eeb-489d-86d1-d043812bb9d3.PNG)
![슬라이드18](https://user-images.githubusercontent.com/58419328/146552072-221488e7-ae09-4d5f-b328-d9ccf3c21c6f.PNG)
![슬라이드19](https://user-images.githubusercontent.com/58419328/146552074-a4e53b0f-c226-4b3d-8232-265a4cd9b145.PNG)
![슬라이드20](https://user-images.githubusercontent.com/58419328/146552084-0dcbb822-c93c-43cf-9f1d-8f247f897931.PNG)
![슬라이드21](https://user-images.githubusercontent.com/58419328/146552090-9b56580d-88f6-4f93-ac8b-0286095d8104.PNG)
![슬라이드22](https://user-images.githubusercontent.com/58419328/146552095-2518caae-49d8-4d8f-97c0-901d8f8afcb6.PNG)
![슬라이드23](https://user-images.githubusercontent.com/58419328/146552100-e4c71fcd-1aed-4a15-8bc0-e85ca77f0d29.PNG)
![슬라이드24](https://user-images.githubusercontent.com/58419328/146552102-5c4e3208-e27a-4cca-8383-7cd9bee8cacd.PNG)

