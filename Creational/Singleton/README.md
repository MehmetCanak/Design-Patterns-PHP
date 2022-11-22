# Singleton

## Intent (Amaç)

- Singleton, kendi türünde yalnızca bir nesnenin var olmasını sağlayan ve diğer tüm kodlar için ona tek bir erişim noktası sağlayan yaratıcı bir tasarım modelidir.

<img src="./RefactoringGuru/singleton.PNG" align="center" height="220" width="210" />

## Sorun 
Singleton modeli, Tek Sorumluluk İlkesini ihlal ederek aynı anda iki sorunu çözer:

>Bir sınıfın yalnızca tek bir örneğe sahip olduğundan emin olun. 
>Neden birisi bir sınıfın kaç örneği olduğunu kontrol etmek istesin ki? 
>Bunun en yaygın nedeni, bir veritabanı veya dosya gibi bazı paylaşılan kaynaklara erişimi kontrol etmektir. 

>- Şöyle çalışır: Bir nesne yarattığınızı, ancak bir süre sonra yeni bir nesne yaratmaya karar verdiğinizi hayal edin. Yeni bir nesne almak yerine, daha önce oluşturduğunuz nesneyi alırsınız. 
>- Bir kurucu çağrısının tasarım gereği her zaman yeni bir nesne döndürmesi gerektiğinden, bu davranışın normal bir kurucu ile uygulanmasının imkansız olduğunu unutmayın.
