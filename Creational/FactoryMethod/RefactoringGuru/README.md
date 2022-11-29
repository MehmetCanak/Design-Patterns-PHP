# `Fabrika Yöntemi`
## Niyet 
### Fabrika Yöntemi, bir üst sınıfta nesne oluşturmak için bir arayüz sağlayan, ancak alt sınıfların oluşturulacak nesnelerin türünü değiştirmesine izin veren yaratıcı bir tasarım modelidir.

## Sorun 

Bir lojistik yönetimi uygulaması oluşturduğunuzu hayal edin. Uygulamanızın ilk sürümü yalnızca kamyonlarla taşımayı işleyebilir, bu nedenle kodunuzun büyük bir kısmı Kamyon sınıfında yer alır.

Bir süre sonra uygulamanız oldukça popüler hale gelir. Her gün deniz taşımacılığı şirketlerinden deniz lojistiğini uygulamaya dahil etmek için onlarca talep alıyorsunuz.

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/problem1-en.png "Fabrika Yöntemi")

Harika haber, değil mi? Peki ya kod? Şu anda kodunuzun çoğu Truck sınıfına bağlıdır. Uygulamaya Gemilerin eklenmesi, kod tabanının tamamında değişiklik yapılmasını gerektirecektir. Ayrıca, daha sonra uygulamaya başka bir ulaşım türü eklemeye karar verirseniz, muhtemelen tüm bu değişiklikleri tekrar yapmanız gerekecektir. 

Sonuç olarak, ulaşım nesnelerinin sınıfına bağlı olarak uygulamanın davranışını değiştiren koşul koşullarıyla dolu oldukça kötü bir kodla karşılaşacaksınız.

## Çözüm

Fabrika Yöntemi, bu sorunu çözmek için tasarlanmıştır. Bu tasarım deseni, üst sınıfta nesne oluşturmak için bir arayüz sağlar, ancak alt sınıfların oluşturulacak nesnelerin türünü değiştirmesine izin verir.

Fabrika Yöntemi modeli, doğrudan nesne oluşturma çağrılarını (yeni işleci kullanarak) özel bir fabrika yöntemine yapılan çağrılarla değiştirmenizi önerir. Endişelenmeyin: nesneler hala new operatörü aracılığıyla oluşturuluyor, ancak fabrika yöntemi içinden çağrılıyor. Fabrika yöntemiyle döndürülen nesnelere genellikle ürün adı verilir.

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/structure.png "Fabrika Yöntemi")

İlk bakışta, bu değişiklik anlamsız görünebilir: yapıcı çağrısını programın bir bölümünden diğerine taşıdık. Ancak şunu göz önünde bulundurun: artık bir alt sınıfta fabrika yöntemini geçersiz kılabilir ve yöntem tarafından oluşturulan ürünlerin sınıfını değiştirebilirsiniz.

Yine de küçük bir sınırlama vardır: alt sınıflar, yalnızca bu ürünlerin ortak bir temel sınıfa veya arayüze sahip olması durumunda farklı türde ürünler getirebilir. Ayrıca, temel sınıftaki fabrika yönteminin dönüş türü bu arabirim olarak bildirilmelidir.

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/solution2-en.png "Fabrika Yöntemi")

Örneğin, hem Truck hem de Ship sınıfları, teslim adlı bir yöntemi bildiren Taşıma arabirimini uygulamalıdır. Her sınıf bu yöntemi farklı şekilde uygular: kamyonlar kargoyu karadan, gemiler kargoyu denizden teslim eder. RoadLogistics sınıfındaki fabrika yöntemi kamyon nesnelerini döndürürken, SeaLogistics sınıfındaki fabrika yöntemi gemileri döndürür.

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/solution3-en.png "Fabrika Yöntemi")

Fabrika yöntemini kullanan kod (genellikle müşteri kodu olarak adlandırılır), çeşitli alt sınıflar tarafından döndürülen gerçek ürünler arasında bir fark görmez. Müşteri, tüm ürünleri soyut Taşıma olarak ele alır. İstemci, tüm taşıma nesnelerinin teslim yöntemine sahip olması gerektiğini bilir, ancak tam olarak nasıl çalıştığı müşteri için önemli değildir.

##  Structure

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/structure.png "Fabrika Yöntemi")

1. Ürünlerin ortak bir arayüzü veya temel sınıfı vardır. Fabrika yöntemi, bu arayüzü veya temel sınıfı döndürür. Ürün, yaratıcısı ve onun alt sınıfları tarafından üretilebilen tüm nesneler için ortak olan arayüzü bildirir.

2. Üretici, ürünlerin fabrika yöntemini bildirir. Bu yöntem, ürünlerin temel sınıfını veya arayüzünü döndürür. Concrete Ürünler, ürün arayüzünün farklı uygulamalarıdır.

3. Creator sınıfı, yeni ürün nesneleri döndüren fabrika yöntemini bildirir. Bu yöntemin dönüş türünün ürün arayüzüyle eşleşmesi önemlidir. Tüm alt sınıfları yöntemin kendi sürümlerini uygulamaya zorlamak için fabrika yöntemini soyut olarak bildirebilirsiniz. Alternatif olarak, temel fabrika yöntemi bazı varsayılan ürün türlerini döndürebilir. Adına rağmen, ürün oluşturmanın yaratıcının birincil sorumluluğu olmadığını unutmayın. Genellikle içerik oluşturucu sınıfı, ürünlerle ilgili bazı temel iş mantığına zaten sahiptir. Fabrika yöntemi, bu mantığı somut ürün sınıflarından ayırmaya yardımcı olur. İşte bir benzetme: Büyük bir yazılım geliştirme şirketi, programcılar için bir eğitim departmanına sahip olabilir. Bununla birlikte, şirketin bir bütün olarak birincil işlevi, programcı üretmek değil, hala kod yazmaktır. Bu nedenle, eğitim departmanı, programcı üretmek için bir fabrika değildir. Ancak, eğitim departmanı, programcıların kod yazma becerilerini geliştirmek için bazı temel eğitimleri sunabilir. Bu eğitimler, programcıların kod yazma becerilerini geliştirmek için kullanılabilir. Bu eğitimler, programcıların kod yazma becerilerini geliştirmek için kullanılabilir.

4. Concrete Oluşturucular, farklı türde bir ürün döndürmek için temel fabrika yöntemini geçersiz kılar. Fabrika yönteminin her zaman yeni örnekler oluşturmak zorunda olmadığını unutmayın. Ayrıca önbellekten, nesne havuzundan veya başka bir kaynaktan varolan nesneleri de döndürebilir.


## UML Sınıf Diyagramı

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/structure-2x.png "Fabrika Yöntemi")

## Sözde kod 

Bu örnek, Fabrika Yönteminin, istemci kodunu somut UI sınıflarına bağlamadan platformlar arası UI öğeleri oluşturmak için nasıl kullanılabileceğini gösterir.

![alt text](https://refactoring.guru/images/patterns/diagrams/factory-method/example.png "Fabrika Yöntemi")

Temel Dialog sınıfı, penceresini oluşturmak için farklı UI öğeleri kullanır. Çeşitli işletim sistemlerinde bu öğeler biraz farklı görünebilir, ancak yine de tutarlı davranmaları gerekir. Windows'ta bir düğme, Linux'ta hala bir düğmedir.

Fabrika yöntemi devreye girdiğinde, her işletim sistemi için Dialog sınıfının mantığını yeniden yazmanıza gerek yoktur. Temel Dialog sınıfı içinde düğmeler üreten bir fabrika yöntemi bildirirsek, daha sonra fabrika yönteminden Windows stili düğmeler döndüren bir alt sınıf oluşturabiliriz. Alt sınıf daha sonra kodun çoğunu temel sınıftan devralır, ancak fabrika yöntemi sayesinde ekranda Windows görünümlü düğmeler oluşturabilir.

Bu kalıbın çalışması için temel Dialog sınıfının soyut düğmelerle çalışması gerekir: tüm somut düğmelerin izlediği bir temel sınıf veya arabirim. Bu şekilde, Dialog içindeki kod, hangi düğme türüyle çalışırsa çalışsın, işlevsel kalır.

Tabii ki, bu yaklaşımı diğer UI öğelerine de uygulayabilirsiniz. Ancak Diyalog'a eklediğiniz her yeni fabrika yöntemiyle Soyut Fabrika modeline biraz daha yaklaşırsınız. Korkmayın, bu kalıp hakkında daha sonra konuşacağız.

```java

// The creator class declares the factory method that must
// return an object of a product class. The creator's subclasses
// usually provide the implementation of this method.
class Dialog is
    // The creator may also provide some default implementation
    // of the factory method.
    abstract method createButton():Button

    // Note that, despite its name, the creator's primary
    // responsibility isn't creating products. It usually
    // contains some core business logic that relies on product
    // objects returned by the factory method. Subclasses can
    // indirectly change that business logic by overriding the
    // factory method and returning a different type of product
    // from it.
    method render() is
        // Call the factory method to create a product object.
        Button okButton = createButton()
        // Now use the product.
        okButton.onClick(closeDialog)
        okButton.render()


// Concrete creators override the factory method to change the
// resulting product's type.
class WindowsDialog extends Dialog is
    method createButton():Button is
        return new WindowsButton()

class WebDialog extends Dialog is
    method createButton():Button is
        return new HTMLButton()


// The product interface declares the operations that all
// concrete products must implement.
interface Button is
    method render()
    method onClick(f)

// Concrete products provide various implementations of the
// product interface.
class WindowsButton implements Button is
    method render(a, b) is
        // Render a button in Windows style.
    method onClick(f) is
        // Bind a native OS click event.

class HTMLButton implements Button is
    method render(a, b) is
        // Return an HTML representation of a button.
    method onClick(f) is
        // Bind a web browser click event.


class Application is
    field dialog: Dialog

    // The application picks a creator's type depending on the
    // current configuration or environment settings.
    method initialize() is
        config = readApplicationConfigFile()

        if (config.OS == "Windows") then
            dialog = new WindowsDialog()
        else if (config.OS == "Web") then
            dialog = new WebDialog()
        else
            throw new Exception("Error! Unknown operating system.")

    // The client code works with an instance of a concrete
    // creator, albeit through its base interface. As long as
    // the client keeps working with the creator via the base
    // interface, you can pass it any creator's subclass.
    method main() is
        this.initialize()
        dialog.render()
```


## Uygulanabilirlik

Fabrika Yöntemi, aşağıdaki durumlarda kullanılabilir:

* Bir sınıfın alt sınıflarının nesnelerini oluşturması gerekiyor, ancak hangi alt sınıfın nesnesinin oluşturulacağı sınıf tarafından belirlenmiyor.
* Nesnelerin oluşturulması için karmaşık bir proses varsa ve bu prosesin alt sınıflarda tekrarlanması istenmiyor.

#### **Kodunuzun birlikte çalışması gereken nesnelerin tam türlerini ve bağımlılıklarını önceden bilmiyorsanız Fabrika Yöntemini kullanın.**

* Fabrika Yöntemi, ürün yapım kodunu, ürünü gerçekten kullanan koddan ayırır. Bu nedenle, ürün yapım kodunu kodun geri kalanından bağımsız olarak genişletmek daha kolaydır. 
- Örneğin, uygulamaya yeni bir ürün türü eklemek için yalnızca yeni bir oluşturucu alt sınıfı oluşturmanız ve içindeki fabrika yöntemini geçersiz kılmanız gerekir.

#### **Kitaplığınızın veya çerçevenizin kullanıcılarına dahili bileşenlerini genişletmenin bir yolunu sağlamak istediğinizde Fabrika Yöntemini kullanın.**

* Kalıtım muhtemelen bir kitaplığın veya çerçevenin varsayılan davranışını genişletmenin en kolay yoludur. Ancak çerçeve, standart bir bileşen yerine alt sınıfınızın kullanılması gerektiğini nasıl anlar?

* Çözüm, çerçevede bileşenleri oluşturan kodu tek bir fabrika yöntemine indirgemek ve bileşenin kendisini genişletmenin yanı sıra herhangi birinin bu yöntemi geçersiz kılmasına izin vermektir.

* Bunun nasıl işe yarayacağını görelim. Açık kaynaklı bir UI çerçevesi kullanarak bir uygulama yazdığınızı hayal edin. Uygulamanızın yuvarlak düğmeleri olmalıdır, ancak çerçeve yalnızca kare düğmeler sağlar. Standart Button sınıfını muhteşem bir RoundButton alt sınıfıyla genişletirsiniz. Ancak şimdi ana UIFramework sınıfına varsayılan yerine yeni düğme alt sınıfını kullanmasını söylemeniz gerekiyor.

* Bunu başarmak için, temel çerçeve sınıfından bir alt sınıf UIWithRoundButtons oluşturursunuz ve bunun createButton yöntemini geçersiz kılarsınız. Bu yöntem temel sınıfta Button nesnelerini döndürürken, alt sınıfınızın RoundButton nesnelerini döndürmesini sağlarsınız. Şimdi UIFramework yerine UIWithRoundButtons sınıfını kullanın. Ve hepsi bu kadar!

#### **Mevcut nesneleri her seferinde yeniden oluşturmak yerine yeniden kullanarak sistem kaynaklarından tasarruf etmek istediğinizde Fabrika Yöntemini kullanın.**

Veritabanı bağlantıları, dosya sistemleri ve ağ kaynakları gibi büyük, yoğun kaynak kullanan nesnelerle uğraşırken bu ihtiyacı sıklıkla yaşarsınız.

* Bu nesneleri her seferinde yeniden oluşturmak yerine, bir fabrika yöntemi kullanarak bir nesneyi yeniden kullanabilirsiniz. Bu yöntem, nesnenin ilk çağrıldığı anda oluşturulmasını sağlar ve ardından nesneyi yeniden kullanır. Bu, nesnenin oluşturulması ve başlatılması için gereken zamanı ve sistem kaynaklarını azaltır.

Mevcut bir nesneyi yeniden kullanmak için yapılması gerekenleri düşünelim:

1. Öncelikle, oluşturulan tüm nesneleri takip etmek için bir miktar depolama alanı oluşturmanız gerekir.
2. Birisi bir nesne istediğinde, program o havuzun içinde boş bir nesne aramalıdır.
3. … ve sonra bunu client koduna döndürün.
4. Boş nesne yoksa, program yeni bir tane oluşturmalı (ve onu havuza eklemelidir).

Bu çok fazla kod! Ve programı yinelenen kodla kirletmemek için hepsi tek bir yere yerleştirilmelidir.

Muhtemelen bu kodun yerleştirilebileceği en bariz ve uygun yer, nesnelerini yeniden kullanmaya çalıştığımız sınıfın kurucusudur. Ancak, bir oluşturucu tanım gereği her zaman yeni nesneler döndürmelidir. Mevcut örnekleri döndüremez.

Bu nedenle, mevcut nesneleri yeniden kullanmanın yanı sıra yeni nesneler oluşturabilen düzenli bir yönteme sahip olmanız gerekir. Bu kulağa bir fabrika yöntemi gibi geliyor.

## Nasıl Uygulanır?

1. Tüm ürünlerin aynı arayüzü takip etmesini sağlayın. Bu arabirim, her üründe anlamlı olan yöntemleri bildirmelidir. 
2. Oluşturucu sınıfının içine boş bir fabrika yöntemi ekleyin. Yöntemin dönüş türü, ortak ürün arabirimiyle eşleşmelidir.
3. Yaratıcının kodunda, ürün kurucularına yapılan tüm referansları bulun. Ürün oluşturma kodunu fabrika yöntemine çıkarırken bunları teker teker fabrika yöntemine yapılan çağrılarla değiştirin.
- İade edilen ürünün türünü kontrol etmek için fabrika yöntemine geçici bir parametre eklemeniz gerekebilir.
- Bu noktada, fabrika yönteminin kodu oldukça çirkin görünebilir. Hangi ürün sınıfının somutlaştırılacağını seçen büyük bir switch ifadesine sahip olabilir. Ama merak etmeyin, yakında düzelteceğiz.

4. Şimdi, fabrika yönteminde listelenen her ürün türü için bir yaratıcı alt sınıf kümesi oluşturun. Alt sınıflarda fabrika yöntemini geçersiz kılın ve temel yöntemden uygun yapım kodu bitlerini çıkarın.
5. Çok fazla ürün türü varsa ve hepsi için alt sınıflar oluşturmak mantıklı değilse, alt sınıflarda temel sınıftan kontrol parametresini yeniden kullanabilirsiniz.
- Örneğin, aşağıdaki sınıf hiyerarşisine sahip olduğunuzu hayal edin: birkaç alt sınıf içeren temel Mail sınıfı: AirMail ve GroundMail; Ulaştırma sınıfları Uçak, Kamyon ve Tren'dir. AirMail sınıfı yalnızca Plane nesnelerini kullanırken, GroundMail hem Truck hem de Train nesneleri ile çalışabilir. Her iki durumu da işlemek için yeni bir alt sınıf (örneğin TrainMail) oluşturabilirsiniz, ancak başka bir seçenek daha var. İstemci kodu, hangi ürünü almak istediğini kontrol etmek için GroundMail sınıfının fabrika yöntemine bir argüman iletebilir.

6. Tüm çıkarmalardan sonra temel fabrika yöntemi boşaldıysa, onu soyut hale getirebilirsiniz. Kalan bir şey varsa, onu yöntemin varsayılan davranışı yapabilirsiniz.

## Lehte ve aleyhte olanlar

### Lehte olanlar

- Yaratıcı ve concrete ürünler arasındaki sıkı bağlantıdan kaçınırsınız. 
- Sorumluluk İlkesi. Ürün oluşturma kodunu programda tek bir yere taşıyarak kodun desteklenmesini kolaylaştırabilirsiniz. 
- Açık/Kapalı İlkesi. Mevcut müşteri kodunu bozmadan yeni ürün türlerini programa tanıtabilirsiniz.

### Aleyhte olanlar

- Modeli uygulamak için birçok yeni alt sınıf tanıtmanız gerektiğinden kod daha karmaşık hale gelebilir. En iyi durum senaryosu, kalıbı mevcut yaratıcı sınıflar hiyerarşisine dahil ettiğiniz zamandır.

## Diğer Kalıplarla İlişkiler

- Pek çok tasarım, Fabrika Yöntemi (alt sınıflar aracılığıyla daha az karmaşık ve daha özelleştirilebilir) kullanılarak başlar ve Abstract Factory, Prototype, veya Builder ile (daha esnek, ancak daha karmaşık) doğru gelişir.

- Abstract Factory sınıfları genellikle bir dizi Fabrika Yöntemine dayalıdır, ancak bu sınıflardaki yöntemleri oluşturmak için Prototip'i de kullanabilirsiniz.

- Koleksiyon alt sınıflarının koleksiyonlarla uyumlu farklı türde iterators döndürmesine izin vermek için Fabrika Yöntemini Iterator ile birlikte kullanabilirsiniz.

- Prototip kalıtıma dayalı değildir, dolayısıyla dezavantajları yoktur. Öte yandan Prototip, klonlanan nesnenin karmaşık bir şekilde başlatılmasını gerektirir. Fabrika Yöntemi kalıtıma dayalıdır ancak bir başlatma adımı gerektirmez.

- Fabrika Yöntemi, Template Methodın bir uzmanlığıdır. Aynı zamanda, bir Fabrika Yöntemi, büyük bir Template Methodın bir adım görevi görebilir.
