# Singleton

## Intent (Amaç)

- Singleton, kendi türünde yalnızca bir nesnenin var olmasını sağlayan ve diğer tüm kodlar için ona tek bir erişim noktası sağlayan yaratıcı bir tasarım modelidir.

<img src="./RefactoringGuru/singleton.PNG" align="center" height="220" width="300" />

## Sorun 
Singleton modeli, Tek Sorumluluk İlkesini ihlal ederek aynı anda iki sorunu çözer:

## 1 - Tek bir nesnenin oluşturulmasını sağlar.

>Bir sınıfın yalnızca tek bir örneğe sahip olduğundan emin olun. 
>Neden birisi bir sınıfın kaç örneği olduğunu kontrol etmek istesin ki? 
>Bunun en yaygın nedeni, bir veritabanı veya dosya gibi bazı paylaşılan kaynaklara erişimi kontrol etmektir. 

>Şöyle çalışır: Bir nesne yarattığınızı, ancak bir süre sonra yeni bir nesne yaratmaya karar verdiğinizi hayal edin. Yeni bir nesne almak yerine, daha önce oluşturduğunuz nesneyi alırsınız. 
>Bir kurucu çağrısının tasarım gereği her zaman yeni bir nesne döndürmesi gerektiğinden, bu davranışın normal bir kurucu ile uygulanmasının imkansız olduğunu unutmayın.

## 2 - Nesneye tek bir erişim noktası sağlar.

> Bu örneğe küresel bir erişim noktası sağlayın. Sizin (tamam, benim) bazı temel nesneleri depolamak için kullandığınız global değişkenleri hatırlıyor musunuz? Çok kullanışlı olmalarına rağmen, herhangi bir kod potansiyel olarak bu değişkenlerin içeriğinin üzerine yazabileceğinden ve uygulamayı çökertebileceğinden çok güvensizdirler.

>Tıpkı global bir değişken gibi, Singleton modeli de programdaki herhangi bir yerden bazı nesnelere erişmenizi sağlar. Ancak, bu örneğin başka bir kod tarafından üzerine yazılmasını da önler. 

>Bu sorunun başka bir yönü daha var: 1. sorunu çözen kodun programınızın her yerine dağılmasını istemezsiniz. Özellikle kodunuzun geri kalanı buna bağlıysa, tek bir sınıf içinde olması çok daha iyidir.