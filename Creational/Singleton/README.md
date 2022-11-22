# Singleton

## Intent (Amaç)

- Singleton, kendi türünde yalnızca bir nesnenin var olmasını sağlayan ve diğer tüm kodlar için ona tek bir erişim noktası sağlayan yaratıcı bir tasarım modelidir.

<img src="./RefactoringGuru/img/singleton.PNG" align="center" height="220" width="300" />

## Sorun 
Singleton modeli, Tek Sorumluluk İlkesini ihlal ederek aynı anda iki sorunu çözer:

### 1 - Tek bir nesnenin oluşturulmasını sağlar.

>Bir sınıfın yalnızca tek bir örneğe sahip olduğundan emin olun. 

>Neden birisi bir sınıfın kaç örneği olduğunu kontrol etmek istesin ki?

>Bunun en yaygın nedeni, bir veritabanı veya dosya gibi bazı paylaşılan kaynaklara erişimi kontrol etmektir. 

>Şöyle çalışır: Bir nesne yarattığınızı, ancak bir süre sonra yeni bir nesne yaratmaya karar verdiğinizi hayal edin. Yeni bir nesne almak yerine, daha önce oluşturduğunuz nesneyi alırsınız. 

>Bir kurucu çağrısının tasarım gereği her zaman yeni bir nesne döndürmesi gerektiğinden, bu davranışın normal bir kurucu ile uygulanmasının imkansız olduğunu unutmayın.

### 2 - Nesneye tek bir erişim noktası sağlar.

> Bu örneğe küresel bir erişim noktası sağlayın. Sizin (tamam, benim) bazı temel nesneleri depolamak için kullandığınız global değişkenleri hatırlıyor musunuz? Çok kullanışlı olmalarına rağmen, herhangi bir kod potansiyel olarak bu değişkenlerin içeriğinin üzerine yazabileceğinden ve uygulamayı çökertebileceğinden çok güvensizdirler.

>Tıpkı global bir değişken gibi, Singleton modeli de programdaki herhangi bir yerden bazı nesnelere erişmenizi sağlar. Ancak, bu örneğin başka bir kod tarafından üzerine yazılmasını da önler. 

>Bu sorunun başka bir yönü daha var: 1. sorunu çözen kodun programınızın her yerine dağılmasını istemezsiniz. Özellikle kodunuzun geri kalanı buna bağlıysa, tek bir sınıf içinde olması çok daha iyidir.

Günümüzde Singleton modeli o kadar popüler hale geldi ki, listelenen sorunlardan yalnızca birini çözse bile insanlar bir şeye singleton diyebilir.

## Çözüm 

Singleton'ın tüm uygulamalarında şu iki ortak adım vardır: 

- Diğer nesnelerin Singleton sınıfıyla new işlecini kullanmasını önlemek için varsayılan oluşturucuyu özel yapın. 
- Yapıcı görevi gören statik bir oluşturma yöntemi oluşturun. Başlık altında, bu yöntem bir nesne oluşturmak için özel kurucuyu çağırır ve onu statik bir alana kaydeder. Bu yönteme yapılan sonraki tüm çağrılar, önbelleğe alınmış nesneyi döndürür. 

Kodunuzun Singleton sınıfına erişimi varsa Singleton'ın statik yöntemini çağırabilir. Bu nedenle, bu yöntem her çağrıldığında, her zaman aynı nesne döndürülür.

## Gerçek Dünya Analojisi 

The government, Singleton modelinin mükemmel bir örneğidir. Bir ülkenin yalnızca bir resmi governmentı olabilir. Governmentları oluşturan bireylerin kişisel kimlikleri ne olursa olsun, "X governmentı" başlığı, sorumlu insan grubunu tanımlayan küresel bir erişim noktasıdır.

<img src="./RefactoringGuru/img/structure.PNG" align="center" height="500" width="600" />

## Sözde kod 

Bu örnekte, veritabanı bağlantı sınıfı Singleton gibi davranır. Bu sınıfın ortak bir yapıcısı yoktur, bu nedenle nesnesini almanın tek yolu getInstance yöntemini çağırmaktır. Bu yöntem, ilk oluşturulan nesneyi önbelleğe alır ve onu sonraki tüm çağrılarda döndürür.

```java

// The Database class defines the `getInstance` method that lets
// clients access the same instance of a database connection
// throughout the program.
class Database is
    // The field for storing the singleton instance should be
    // declared static.
    private static field instance: Database

    // The singleton's constructor should always be private to
    // prevent direct construction calls with the `new`
    // operator.
    private constructor Database() is
        // Some initialization code, such as the actual
        // connection to a database server.
        // ...

    // The static method that controls access to the singleton
    // instance.
    public static method getInstance() is
        if (Database.instance == null) then
            acquireThreadLock() and then
                // Ensure that the instance hasn't yet been
                // initialized by another thread while this one
                // has been waiting for the lock's release.
                if (Database.instance == null) then
                    Database.instance = new Database()
        return Database.instance

    // Finally, any singleton should define some business logic
    // which can be executed on its instance.
    public method query(sql) is
        // For instance, all database queries of an app go
        // through this method. Therefore, you can place
        // throttling or caching logic here.
        // ...

class Application is
    method main() is
        Database foo = Database.getInstance()
        foo.query("SELECT ...")
        // ...
        Database bar = Database.getInstance()
        bar.query("SELECT ...")
        // The variable `bar` will contain the same object as
        // the variable `foo`.
```

## Uygulanabilirlik

**Programınızdaki bir sınıfın tüm istemciler için yalnızca tek bir örneğe sahip olması gerektiğinde Singleton modelini kullanın; örneğin, programın farklı bölümleri tarafından paylaşılan tek bir veritabanı nesnesi.**

>Singleton modeli, özel oluşturma yöntemi dışında, bir sınıfın nesnelerini oluşturmanın diğer tüm yollarını devre dışı bırakır. Bu yöntem ya yeni bir nesne yaratır ya da önceden oluşturulmuşsa var olan bir nesneyi döndürür.

**Global değişkenler üzerinde daha sıkı kontrole ihtiyaç duyduğunuzda Singleton modelini kullanın.**

> Global değişkenlerin aksine Singleton modeli, bir sınıfın yalnızca bir örneğinin olduğunu garanti eder. Singleton sınıfının kendisi dışında hiçbir şey önbelleğe alınan örneğin yerini alamaz. Bu sınırlamayı her zaman ayarlayabileceğinizi ve istediğiniz sayıda Singleton örneği oluşturmaya izin verebileceğinizi unutmayın. Değiştirilmesi gereken tek kod parçası, getInstance yönteminin gövdesidir.

## Nasıl Uygulanır? 

- Singleton örneğini depolamak için sınıfa özel bir statik alan ekleyin. 
- Singleton örneğini almak için genel bir statik oluşturma yöntemi bildirin. 
- Statik yöntem içinde "tembel başlatma" uygulayın. İlk çağrısında yeni bir nesne oluşturmalı ve onu statik alana koymalıdır. 
- Yöntem, sonraki tüm çağrılarda her zaman bu örneği döndürmelidir. Sınıfın yapıcısını özel yapın. Sınıfın statik yöntemi yine de yapıcıyı çağırabilir, ancak diğer nesneleri çağıramaz. 
- İstemci kodunu gözden geçirin ve singleton'ın yapıcısına yapılan tüm doğrudan çağrıları, statik oluşturma yöntemine yapılan çağrılarla değiştirin.

## Lehte ve aleyhte olanlar 

### Lehte olanlar

- Bir sınıfın yalnızca tek bir örneğine sahip olduğundan emin olabilirsiniz. 
- Bu örneğe küresel bir erişim noktası kazanırsınız. 
- Singleton nesnesi, yalnızca ilk kez istendiğinde başlatılır. 

### Aleyhte olanlar

- Tek Sorumluluk İlkesini İhlal Eder. Model aynı anda iki sorunu çözer. 
- Singleton deseni, örneğin programın bileşenleri birbirleri hakkında çok fazla şey bildiğinde, kötü tasarımı maskeleyebilir.
- Desen, çok iş parçacıklı bir ortamda özel işlem gerektirir, böylece birden çok iş parçacığı birkaç kez tek bir nesne oluşturmaz. 
- Singleton'ın istemci kodunu test etmek zor olabilir çünkü birçok test çerçevesi, sahte nesneler üretirken kalıtıma dayanır. 
- Singleton sınıfının oluşturucusu özel olduğundan ve çoğu dilde statik yöntemleri geçersiz kılmak imkansız olduğundan, singleton ile taklit etmenin yaratıcı bir yolunu düşünmeniz gerekir. Ya da sadece testleri yazmayın. Veya Singleton modelini kullanmayın.

## Diğer Kalıplarla İlişkiler 

Çoğu durumda tek bir cephe nesnesi yeterli olduğundan, bir Cephe sınıfı genellikle bir Singleton'a dönüştürülebilir. 
Bir şekilde nesnelerin tüm paylaşılan durumlarını tek bir uçucu ağırlık nesnesine indirgemeyi başardıysanız, Flyweight Singleton'a benzer. Ancak bu kalıplar arasında iki temel fark vardır: 

- Yalnızca bir Singleton örneği olmalıdır, oysa bir Flyweight sınıfı, farklı içsel durumlara sahip birden çok örneğe sahip olabilir.
- Singleton nesnesi değişken olabilir. Flyweight nesneleri sabittir. 

Abstract Factories,  Builders  ve  Prototypes lerin tümü Singleton olarak uygulanabilir.

